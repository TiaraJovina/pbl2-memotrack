@php
    $role = 'mahasiswa'; // Change to 'mahasiswa' to test student view
@endphp

<x-layout title="Attendance" role="{{$role}}">
    <!-- Attendance Header -->
    <header class="mb-8">
        <h2 class="text-3xl font-bold text-gray-900">Attendance</h2>
        <p class="text-gray-600 mt-2">{{ $role === 'dosen' ? 'Create and manage attendance for your courses.' : 'Mark your attendance for course sessions.' }}</p>
    </header>

    <!-- Attendance Layout -->
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Attendance List Section -->
        <div class="bg-white p-6 rounded-lg shadow-md lg:col-span-2">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Attendance Sessions</h3>
                @if($role === 'dosen')
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition" onclick="openAddAttendanceModal()">Add Session</button>
                @endif
            </div>
            <input type="text" id="searchAttendance" placeholder="Search sessions..." class="w-full px-4 py-2 mb-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" oninput="searchAttendance()">
            <ul id="attendanceList" class="space-y-2">
                <li class="p-3 bg-blue-50 rounded-md cursor-pointer" onclick="selectAttendance('Sistem Operasi - Lecture 1', '2025-04-21, 09:00 - 11:00, Room A-101', '2025-04-21')">
                    <span class="text-gray-900 font-medium">Sistem Operasi - Lecture 1</span>
                    <span class="text-sm text-gray-500 block">2025-04-21, 09:00 - 11:00</span>
                </li>
                <li class="p-3 bg-blue-50 rounded-md cursor-pointer" onclick="selectAttendance('Pemrograman Web - Tutorial 1', '2025-04-23, 13:00 - 15:00, Lab B-202', '2025-04-23')">
                    <span class="text-gray-900 font-medium">Pemrograman Web - Tutorial 1</span>
                    <span class="text-sm text-gray-500 block">2025-04-23, 13:00 - 15:00</span>
                </li>
                <li class="p-3 bg-blue-50 rounded-md cursor-pointer" onclick="selectAttendance('Database Systems - Review', '2025-04-25, 10:00 - 12:00, Room C-303', '2025-04-25')">
                    <span class="text-gray-900 font-medium">Database Systems - Review</span>
                    <span class="text-sm text-gray-500 block">2025-04-25, 10:00 - 12:00</span>
                </li>
            </ul>
        </div>

        <!-- Attendance Details Section -->
        <div class="bg-white p-6 rounded-lg shadow-md lg:col-span-1" style="background-image: linear-gradient(#e5e7eb 1px, transparent 1px); background-size: 100% 2rem;">
            <h3 id="attendanceTitle" class="text-xl font-semibold text-gray-900 mb-4 relative">
                Session Details
                <span class="absolute bottom-0 left-0 w-full h-1 bg-red-500" style="background-image: url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 10%22 preserveAspectRatio=%22none%22%3E%3Cpath d=%22M0 5 Q 25 0 50 5 T 100 5%22 stroke=%22%23ef4444%22 stroke-width=%222%22 fill=%22none%22/%3E%3C/svg%3E'); background-size: 100% 100%;"></span>
            </h3>
            <p id="attendanceContent" class="text-gray-600 leading-loose" style="line-height: 2rem;">Select a session from the list to view its details.</p>
            <div class="mt-4">
                @if($role === 'dosen')
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition" onclick="editAttendance()">Edit Session</button>
                    <button class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition ml-2" onclick="deleteAttendance()">Delete Session</button>
                @else
                    <button id="markAttendanceButton" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition" onclick="markAttendance()">Mark Attendance</button>
                @endif
            </div>
        </div>
    </section>

    <!-- Add/Edit Attendance Modal (Dosen Only) -->
    @if($role === 'dosen')
        <div id="attendanceModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
            <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
                <h3 id="attendanceModalTitle" class="text-lg font-semibold text-gray-900 mb-4">Add New Session</h3>
                <form id="attendanceForm">
                    <div class="mb-4">
                        <label for="attendanceTitleInput" class="block text-gray-600 mb-2">Session Title</label>
                        <input type="text" id="attendanceTitleInput" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter session title" required>
                    </div>
                    <div class="mb-4">
                        <label for="attendanceDetailsInput" class="block text-gray-600 mb-2">Details</label>
                        <input type="text" id="attendanceDetailsInput" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="e.g., Date, Time, Location" required>
                    </div>
                    <div class="mb-4">
                        <label for="attendanceDate" class="block text-gray-600 mb-2">Date</label>
                        <input type="date" id="attendanceDate" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition" onclick="closeAttendanceModal()">Cancel</button>
                        <button type="button" id="saveAttendanceButton" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition" onclick="saveAttendance()">Save</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- Mark Attendance Modal (Mahasiswa Only) -->
    @if($role === 'mahasiswa')
        <div id="markAttendanceModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
            <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Mark Attendance</h3>
                <form>
                    <div class="mb-4">
                        <label class="block text-gray-600 mb-2">Session</label>
                        <p id="markAttendanceSession" class="text-gray-900"></p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-600 mb-2">Status</label>
                        <select id="attendanceStatus" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <option value="Present">Present</option>
                            <option value="Absent">Absent</option>
                            <option value="Late">Late</option>
                        </select>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition" onclick="closeMarkAttendanceModal()">Cancel</button>
                        <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition" onclick="submitAttendance()">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <script>
        let selectedAttendanceTitle = null;
        let isEditing = false;

        function searchAttendance() {
            const input = document.getElementById('searchAttendance').value.toLowerCase();
            const attendanceList = document.getElementById('attendanceList').children;
            for (let i = 0; i < attendanceList.length; i++) {
                const title = attendanceList[i].querySelector('span').textContent.toLowerCase();
                attendanceList[i].style.display = title.includes(input) ? '' : 'none';
            }
        }

        function selectAttendance(title, content, date) {
            selectedAttendanceTitle = title;
            document.getElementById('attendanceTitle').innerText = title;
            document.getElementById('attendanceContent').innerText = content;
            @if($role === 'mahasiswa')
                const markButton = document.getElementById('markAttendanceButton');
                const today = new Date().toISOString().split('T')[0];
                markButton.disabled = date !== today;
                markButton.classList.toggle('bg-gray-400', date !== today);
                markButton.classList.toggle('bg-blue-500', date === today);
                markButton.classList.toggle('cursor-not-allowed', date !== today);
                markButton.classList.toggle('hover:bg-blue-600', date === today);
            @endif
        }

        function openAddAttendanceModal() {
            isEditing = false;
            document.getElementById('attendanceModalTitle').innerText = 'Add New Session';
            document.getElementById('attendanceTitleInput').value = '';
            document.getElementById('attendanceDetailsInput').value = '';
            document.getElementById('attendanceDate').value = '';
            document.getElementById('saveAttendanceButton').onclick = saveAttendance;
            document.getElementById('attendanceModal').classList.remove('hidden');
        }

        function openEditAttendanceModal() {
            if (!selectedAttendanceTitle) {
                alert('Please select a session to edit.');
                return;
            }
            isEditing = true;
            const selectedItem = Array.from(document.getElementById('attendanceList').children).find(
                li => li.querySelector('span').textContent === selectedAttendanceTitle
            );
            if (selectedItem) {
                document.getElementById('attendanceModalTitle').innerText = 'Edit Session';
                document.getElementById('attendanceTitleInput').value = selectedAttendanceTitle;
                document.getElementById('attendanceDetailsInput').value = document.getElementById('attendanceContent').innerText;
                document.getElementById('attendanceDate').value = selectedItem.querySelector('.text-sm').textContent.split(', ')[0];
                document.getElementById('saveAttendanceButton').onclick = saveAttendance;
                document.getElementById('attendanceModal').classList.remove('hidden');
            }
        }

        function closeAttendanceModal() {
            document.getElementById('attendanceModal').classList.add('hidden');
            document.getElementById('attendanceTitleInput').value = '';
            document.getElementById('attendanceDetailsInput').value = '';
            document.getElementById('attendanceDate').value = '';
        }

        function saveAttendance() {
            const title = document.getElementById('attendanceTitleInput').value;
            const details = document.getElementById('attendanceDetailsInput').value;
            const date = document.getElementById('attendanceDate').value;
            if (title && details && date) {
                const attendanceList = document.getElementById('attendanceList');
                if (isEditing) {
                    const items = attendanceList.children;
                    for (let i = 0; i < items.length; i++) {
                        if (items[i].querySelector('span').textContent === selectedAttendanceTitle) {
                            items[i].innerHTML = `<span class="text-gray-900 font-medium">${title}</span><span class="text-sm text-gray-500 block">${details}</span>`;
                            items[i].onclick = () => selectAttendance(title, details, date);
                            break;
                        }
                    }
                } else {
                    const li = document.createElement('li');
                    li.className = 'p-3 bg-blue-50 rounded-md cursor-pointer';
                    li.innerHTML = `<span class="text-gray-900 font-medium">${title}</span><span class="text-sm text-gray-500 block">${details}</span>`;
                    li.onclick = () => selectAttendance(title, details, date);
                    attendanceList.prepend(li);
                }
                selectAttendance(title, details, date);
                closeAttendanceModal();
            }
        }

        function editAttendance() {
            openEditAttendanceModal();
        }

        function deleteAttendance() {
            if (!selectedAttendanceTitle) {
                alert('Please select a session to delete.');
                return;
            }
            if (confirm(`Are you sure you want to delete "${selectedAttendanceTitle}"?`)) {
                const attendanceList = document.getElementById('attendanceList').children;
                for (let i = 0; i < attendanceList.length; i++) {
                    if (attendanceList[i].querySelector('span').textContent === selectedAttendanceTitle) {
                        attendanceList[i].remove();
                        break;
                    }
                }
                document.getElementById('attendanceTitle').innerText = 'Session Details';
                document.getElementById('attendanceContent').innerText = 'Select a session from the list to view its details.';
                selectedAttendanceTitle = null;
            }
        }

        function openMarkAttendanceModal() {
            if (!selectedAttendanceTitle) {
                alert('Please select a session to mark attendance.');
                return;
            }
            document.getElementById('markAttendanceSession').innerText = selectedAttendanceTitle;
            document.getElementById('attendanceStatus').value = 'Present';
            document.getElementById('markAttendanceModal').classList.remove('hidden');
        }

        function closeMarkAttendanceModal() {
            document.getElementById('markAttendanceModal').classList.add('hidden');
            document.getElementById('markAttendanceSession').innerText = '';
        }

        function markAttendance() {
            const today = new Date().toISOString().split('T')[0];
            const selectedItem = Array.from(document.getElementById('attendanceList').children).find(
                li => li.querySelector('span').textContent === selectedAttendanceTitle
            );
            if (selectedItem) {
                const sessionDate = selectedItem.querySelector('.text-sm').textContent.split(', ')[0];
                if (sessionDate !== today) {
                    alert('Attendance can only be marked for today\'s sessions.');
                    return;
                }
                openMarkAttendanceModal();
            }
        }

        function submitAttendance() {
            const status = document.getElementById('attendanceStatus').value;
            if (status) {
                alert(`Attendance marked as "${status}" for "${selectedAttendanceTitle}".`);
                closeMarkAttendanceModal();
            }
        }
    </script>
</x-layout>