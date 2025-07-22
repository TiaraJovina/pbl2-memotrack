@php
    $role = 'dosen'; // Change to 'mahasiswa' to test student view
@endphp

<x-layout title="Profile" role="{{$role}}">
    <!-- Profile Header -->
    <header class="mb-8">
        <h2 class="text-3xl font-bold text-gray-900">Profile</h2>
        <p class="text-gray-600 mt-2">View and update your personal information.</p>
    </header>

    <!-- Profile Layout -->
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Profile Information -->
        <div class="bg-white p-6 rounded-lg shadow-md lg:col-span-2">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900">User Information</h3>
                <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition" onclick="openEditProfileModal()">Edit Profile</button>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="block text-gray-600 font-medium">Name</label>
                    <p id="profileName" class="text-gray-900">{{ $role === 'dosen' ? 'Dr. John Doe' : 'Jane Smith' }}</p>
                </div>
                <div>
                    <label class="block text-gray-600 font-medium">Email</label>
                    <p id="profileEmail" class="text-gray-900">{{ $role === 'dosen' ? 'john.doe@university.ac.id' : 'jane.smith@university.ac.id' }}</p>
                </div>
                <div>
                    <label class="block text-gray-600 font-medium">Role</label>
                    <p id="profileRole" class="text-gray-900">{{ $role === 'dosen' ? 'Dosen' : 'Mahasiswa' }}</p>
                </div>
                <div>
                    <label class="block text-gray-600 font-medium">Bio</label>
                    <p id="profileBio" class="text-gray-900">{{ $role === 'dosen' ? 'Senior lecturer in Computer Science with 10 years of experience.' : 'Third-year Computer Science student passionate about web development.' }}</p>
                </div>
            </div>
        </div>

        <!-- Profile Summary -->
        <div class="bg-white p-6 rounded-lg shadow-md lg:col-span-1" style="background-image: linear-gradient(#e5e7eb 1px, transparent 1px); background-size: 100% 2rem;">
            <h3 class="text-xl font-semibold text-gray-900 mb-4 relative">
                Profile Summary
                <span class="absolute bottom-0 left-0 w-full h-1 bg-red-500" style="background-image: url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 10%22 preserveAspectRatio=%22none%22%3E%3Cpath d=%22M0 5 Q 25 0 50 5 T 100 5%22 stroke=%22%23ef4444%22 stroke-width=%222%22 fill=%22none%22/%3E%3C/svg%3E'); background-size: 100% 100%;"></span>
            </h3>
            <div class="space-y-4">
                <div>
                    <p class="text-gray-600">Courses Enrolled</p>
                    <p class="text-2xl font-bold text-blue-500">{{ $role === 'dosen' ? '3' : '5' }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Notes Created</p>
                    <p class="text-2xl font-bold text-blue-500">12</p>
                </div>
                <div>
                    <p class="text-gray-600">Tasks Completed</p>
                    <p class="text-2xl font-bold text-blue-500">{{ $role === 'dosen' ? 'N/A' : '8' }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Edit Profile Modal -->
    <div id="editProfileModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Edit Profile</h3>
            <form id="editProfileForm">
                <div class="mb-4">
                    <label for="editName" class="block text-gray-600 mb-2">Name</label>
                    <input type="text" id="editName" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your name" required>
                </div>
                <div class="mb-4">
                    <label for="editEmail" class="block text-gray-600 mb-2">Email</label>
                    <input type="email" id="editEmail" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your email" required>
                </div>
                <div class="mb-4">
                    <label for="editBio" class="block text-gray-600 mb-2">Bio</label>
                    <textarea id="editBio" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your bio" rows="4" required></textarea>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition" onclick="closeEditProfileModal()">Cancel</button>
                    <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition" onclick="saveProfile()">Save</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditProfileModal() {
            const name = document.getElementById('profileName').innerText;
            const email = document.getElementById('profileEmail').innerText;
            const bio = document.getElementById('profileBio').innerText;
            document.getElementById('editName').value = name;
            document.getElementById('editEmail').value = email;
            document.getElementById('editBio').value = bio;
            document.getElementById('editProfileModal').classList.remove('hidden');
        }

        function closeEditProfileModal() {
            document.getElementById('editProfileModal').classList.add('hidden');
            document.getElementById('editName').value = '';
            document.getElementById('editEmail').value = '';
            document.getElementById('editBio').value = '';
        }

        function saveProfile() {
            const name = document.getElementById('editName').value;
            const email = document.getElementById('editEmail').value;
            const bio = document.getElementById('editBio').value;

            // Basic validation
            if (!name || !email || !bio) {
                alert('Please fill in all fields.');
                return;
            }
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                alert('Please enter a valid email address.');
                return;
            }

            // Update profile display
            document.getElementById('profileName').innerText = name;
            document.getElementById('profileEmail').innerText = email;
            document.getElementById('profileBio').innerText = bio;

            closeEditProfileModal();
            alert('Profile updated successfully!');
        }
    </script>
</x-layout>