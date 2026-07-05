<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\City;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\RoomImage;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function home()
    {
        return view('admin.home');
    }

    function user()
    {
        $users = User::latest()->get();
        return view('admin.users', compact('users'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'nullable|string',
            'role' => 'required|in:admin,user',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role,
        ]);

        return redirect()->back()->with('success', 'User updated!');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User deleted!');
    }



    function addhotelPage()
    {
        return view('admin.addhotel');
    }

    // AdminController.php

    public function hotels()
    {
        $hotels = Hotel::with('city')->latest()->get();
        return view('admin.hotels', compact('hotels'));
    }

    public function updateHotel(Request $request, $id)
    {
        $hotel = Hotel::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'city_id' => 'required|exists:cities,id',
        ]);

        $hotel->update($request->all());

        return redirect()->back()->with('success', 'Hotel updated!');
    }

    public function deleteHotel($id)
    {
        $hotel = Hotel::findOrFail($id);
        $hotel->delete();

        return redirect()->back()->with('success', 'Hotel deleted!');
    }

    function addRoomPage()
    {
        return view('admin.addRoom');
    }

    function addcity(Request $request)
    {
        $fields = $request->validate([
            'name' => ['required', 'between:1,255'],
            'country' => ['required', 'between:1,255'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'description' => ['sometimes'],
        ]);


        $image = $request->file('image');
        $imagename = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('assets/images/cities'), $imagename);

        $fields['image'] = $imagename;

        City::create($fields);
        return redirect()->back();
    }

    function addhotel(Request $request)
    {
        $fields = $request->validate([
            'name' => ['required', 'between:1,255'],
            'city_id' => ['required', 'integer'],
            'description' => ['required', 'between:1,255'],
            'address' => ['required', 'between:1,255'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        // Handle image upload
        $image = $request->file('image');
        $imagename = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('assets/images/hotels'), $imagename);

        $fields['image'] = $imagename;

        Hotel::create($fields);
        return redirect()->back();
    }

    public function addRoom(Request $request)
    {
        // Validate WITHOUT image
        $fields = $request->validate([
            'hotel_id' => ['required', 'integer'],
            'room_type' => ['required', 'between:1,255'],
            'room_number' => ['required', 'integer'],
            'capacity' => ['required', 'integer'],
            'price' => ['required', 'numeric'],
            'is_available' => ['required', 'in:0,1'],
        ]);

        // Upload image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images/rooms'), $imagename);

            // MANUALLY add image to fields
            $fields['image'] = $imagename;
        }

        // Create
        Room::create($fields);
        return redirect()->back()->with('success', 'Room added successfully!');
    }

    public function addRoomImages(Request $request)
    {
        $request->validate([
            'room_id' => 'required|integer',
            'images' => 'required',
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $filename = time() . rand(1000, 9999) . '.' . $img->getClientOriginalExtension();
                $img->move(public_path('assets/images/rooms'), $filename);

                RoomImage::create([
                    'room_id' => $request->room_id,
                    'image' => $filename,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Images uploaded!');
    }


    public function bookings()
    {
        $bookings = Booking::with(['user', 'room.hotel'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.bookings', compact('bookings'));
    }

    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $status = $request->input('status');

        if ($status === 'cancelled' && $booking->status !== 'cancelled') {
            $booking->room->update(['is_available' => 1]);
        }

        if ($booking->status === 'cancelled' && $status !== 'cancelled') {
            $booking->room->update(['is_available' => 0]);
        }

        $booking->update(['status' => $status]);
        return redirect()->back()->with('success', 'Status updated!');
    }

    public function deleteBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->room->update(['is_available' => 1]);
        $booking->delete();
        return redirect()->back()->with('success', 'Booking deleted!');
    }
}
