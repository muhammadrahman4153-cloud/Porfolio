<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;

class MessageController extends Controller
{
    public function index()
    {
        return view('admin.messages.index', ['messages' => Message::latest()->paginate(10)]);
    }

    public function show($id)
    {
        $message = Message::findOrFail($id);
        $message->update(['is_read' => true]);

        return view('admin.messages.show', compact('message'));
    }

    public function destroy($id)
    {
        Message::findOrFail($id)->delete();

        return redirect()->route('admin.messages.index')->with('success', 'Pesan berhasil dihapus.');
    }
}
