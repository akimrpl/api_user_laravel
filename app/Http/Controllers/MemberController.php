<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    /**
     * @OA\Get(
     *     path="/api/member",
     *     summary="Ambil semua member",
     *     tags={"Member"},
     *     @OA\Response(
     *         response=200,
     *         description="Data member berhasil diambil"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Tidak ada data member ditemukan"
     *     )
     * )
     */

    // Menampilkan semua member
    public function index()
    {
        $members = Member::all();
        Log::info('Get all members', ['members' => $members]);

        return response()->json($members);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    /**
     * @OA\Post(
     *     path="/api/member",
     *     summary="Tambah member baru",
     *     tags={"Member"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nama", "email"},
     *             @OA\Property(property="nama", type="string"),
     *             @OA\Property(property="email", type="string", format="email")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Member berhasil ditambahkan"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Request body invalid"
     *     )
     * )
     */
    // Menambahkan member baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email',
            'age' => 'required|integer|min:1',
        ]);

        // Menambahkan user baru
        $member = Member::create([
            'name' => $request->name,
            'email' => $request->email,
            'age' => $request->age,
        ]);

        Log::info('Member created', ['member' => $member]);

        return response()->json($member, 201);
    }

    /**
     * Display the specified resource.
     */

    /**
     * @OA\Get(
     *     path="/api/member/{id}",
     *     summary="Ambil detail member berdasarkan ID",
     *     tags={"Member"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detail member ditemukan"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Member tidak ditemukan"
     *     )
     * )
     */
    // Menampilkan member berdasarkan ID
    public function show($id)
    {
        $member = Member::find($id);

        if (!$member) {
            Log::error('Member not found', ['id' => $id]);
            return response()->json(['message' => 'Member not found'], 404);
        }

        Log::info('Get member', ['id' => $id, 'member' => $member]);

        return response()->json($member);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    /**
     * @OA\Put(
     *     path="/api/member/{id}",
     *     summary="Update data member",
     *     tags={"Member"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nama", "email"},
     *             @OA\Property(property="nama", type="string"),
     *             @OA\Property(property="email", type="string", format="email")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Member berhasil diupdate"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Member tidak ditemukan"
     *     )
     * )
     */
    // Memperbarui data member
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email,' . $id, // Email unik kecuali pada member yang sama
            'age' => 'required|integer|min:1',
        ]);

        $member = Member::find($id);

        if (!$member) {
            Log::error('Member not found for update', ['id' => $id]);
            return response()->json(['message' => 'Member not found'], 404);
        }

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:members,email,' . $id,
            'age' => 'required|integer',
        ]);

        $member->update($request->all());

        Log::info('Member updated', ['id' => $id, 'member' => $member]);

        return response()->json($member);
    }

    /**
     * Remove the specified resource from storage.
     */

    /**
     * @OA\Delete(
     *     path="/api/member/{id}",
     *     summary="Hapus data member",
     *     tags={"Member"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Member berhasil dihapus"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Member tidak ditemukan"
     *     )
     * )
     */
    // Menghapus member
    public function destroy($id)
    {
        $member = Member::find($id);

        if (!$member) {
            Log::error('Member not found for delete', ['id' => $id]);
            return response()->json(['message' => 'Member not found'], 404);
        }

        $member->delete();

        Log::info('Member deleted', ['id' => $id]);

        return response()->json(['message' => 'Member deleted']);
    }
}
