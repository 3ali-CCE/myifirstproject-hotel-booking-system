<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\City;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\RoomImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class mainController extends Controller
{
    function home()
    {
        $cities = City::latest()->get();
        $hotels = Hotel::latest()->take(8)->get();

        return view('main.home', compact('cities', 'hotels'));
    }

    function services()
    {
        return view('main.services');
    }

    public function cityHotels($id)
    {
        $city = City::findOrFail($id);
        $hotels = Hotel::where('city_id', $id)->get();

        return view('main.cityHotels', compact('city', 'hotels'));
    }

    public function hotelRooms($id)
    {
        $hotel = Hotel::findOrFail($id);
        $rooms = Room::where('hotel_id', $hotel->id)->get();

        foreach ($rooms as $room) {
            $activeBooking = Booking::where('room_id', $room->id)
                ->whereIn('status', ['confirmed'])
                ->first();
            $room->is_booked = $activeBooking ? true : false;
        }

        return view('main.hotelRooms', compact('hotel', 'rooms'));
    }

    public function createBooking($roomId)
    {
        $room = Room::findOrFail($roomId);

        $roomImages = RoomImage::where('room_id', $roomId)->get();
        return view('main.booking', compact('room', 'roomImages'));
    }

    public function storeBooking(Request $request)
    {
        $fields = $request->validate([
            'room_id' => 'required|integer',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'total_guests' => 'required|integer',
            'payment_method' => 'required|in:cash,card',
        ]);

        // Get room
        $room = Room::findOrFail($fields['room_id']);

        // Calculate nights and price
        $checkIn = Carbon::parse($fields['check_in']);
        $checkOut = Carbon::parse($fields['check_out']);
        $nights = $checkIn->diffInDays($checkOut);

        if ($nights < 1) {
            $nights = 1;
        }
        $totalPrice = $nights * $room->price;

        Booking::create([
            'user_id' => Auth::id(),
            'room_id' => $fields['room_id'],
            'check_in' => $fields['check_in'],
            'check_out' => $fields['check_out'],
            'total_guests' => $fields['total_guests'],
            'total_price' => $totalPrice,
            'payment_method' => $fields['payment_method'],
            'status' => $fields['payment_method'] === 'card' ? 'confirmed' : 'pending',
        ]);
        $room->update(['is_available' => 0]);

        return redirect()->back()->with('success', 'Booking submitted!');
    }
}
