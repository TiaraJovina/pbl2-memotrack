@php
    $role = 'dosen';
@endphp

<x-layout title="Notes" role="{{$role}}">
    <!-- Notes Header -->
    <header class="mb-8">
        <h2 class="text-3xl font-bold text-gray-900">Notes</h2>
        <p class="text-gray-600 mt-2">Organize and review your course notes here.</p>
    </header>

    <!-- Notes Layout -->
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Note List Section -->
        <div class="bg-white p-6 rounded-lg shadow-md lg:col-span-1">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Your Notes</h3>
                <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition" onclick="openAddNoteModal()">Add Note</button>
            </div>
            <input type="text" id="searchNotes" placeholder="Search notes..." class="w-full px-4 py-2 mb-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" oninput="searchNotes()">
            <ul id="noteList" class="space-y-2">
                 <li class="p-3 bg-blue-50 rounded-md cursor-pointer hover:bg-blue-100 transition" onclick="selectNote('Nasi Padang', 'Details about Nasi Padang preparation.')">
                    <span class="text-gray-900">Buat tugas web
                        
                    </span>
                    <span class="text-sm text-gray-500 block">Created: 2025-04-10</span>
                </li>
                <li class="p-3 bg-blue-50 rounded-md cursor-pointer hover:bg-blue-100 transition" onclick="selectNote('Nasi Padang', 'Details about Nasi Padang preparation.')">
                    <span class="text-gray-900">Belajar coding</span>
                    <span class="text-sm text-gray-500 block">Created: 2025-04-10</span>
                </li>
                <li class="p-3 bg-blue-50 rounded-md cursor-pointer hover:bg-blue-100 transition" onclick="selectNote('Nasi Goreng', 'Recipe and variations of Nasi Goreng.')">
                    <span class="text-gray-900">Belajar hack</span>
                    <span class="text-sm text-gray-500 block">Created: 2025-04-09</span>
                </li>
                <li class="p-3 bg-blue-50 rounded-md cursor-pointer hover:bg-blue-100 transition" onclick="selectNote('Sate Ayam', 'Notes on Sate Ayam marinade.')">
                    <span class="text-gray-900">Makan cicak🦎</span>
                    <span class="text-sm text-gray-500 block">Created: 2025-04-08</span>
                </li>
                <li class="p-3 bg-blue-50 rounded-md cursor-pointer hover:bg-blue-100 transition" onclick="selectNote('Rendang Daging', 'Traditional Rendang cooking steps.')">
                    <span class="text-gray-900">Goyang blender ala nazar💃🏻</span>
                    <span class="text-sm text-gray-500 block">Created: 2025-04-07</span>
                </li>
                <li class="p-3 bg-blue-50 rounded-md cursor-pointer hover:bg-blue-100 transition" onclick="selectNote('Gado-Gado', 'Gado-Gado sauce recipe.')">
                    <span class="text-gray-900">Makan batu</span>
                    <span class="text-sm text-gray-500 block">Created: 2025-04-06</span>
                </li>
            </ul>
        </div>

        <!-- Note Preview Section -->
        <div class="bg-white p-6 rounded-lg shadow-md lg:col-span-2 relative" style="background-image: linear-gradient(#e5e7eb 1px, transparent 1px); background-size: 100% 2rem;">
            <h3 id="noteTitle" class="text-xl font-semibold text-gray-900 mb-4 relative">
                Select a note
                <span class="absolute bottom-0 left-0 w-full h-1 bg-red-500" style="background-image: url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 10%22 preserveAspectRatio=%22none%22%3E%3Cpath d=%22M0 5 Q 25 0 50 5 T 100 5%22 stroke=%22%23ef4444%22 stroke-width=%222%22 fill=%22none%22/%3E%3C/svg%3E'); background-size: 100% 100%;"></span>
            </h3>
            <p id="noteContent" class="text-gray-600 leading-loose" style="line-height: 2rem;">Click a note from the list to view its details.</p>
            <div class="mt-4">
                <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition" onclick="editNote()">Edit Note</button>
                <button class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition ml-2" onclick="deleteNote()">Delete Note</button>
            </div>
        </div>
    </section>

    <!-- Add Note Modal -->
    <div id="addNoteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Add New Note</h3>
            <form>
                <div class="mb-4">
                    <label for="newNoteTitle" class="block text-gray-600 mb-2">Title</label>
                    <input type="text" id="newNoteTitle" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter note title" required>
                </div>
                <div class="mb-4">
                    <label for="newNoteContent" class="block text-gray-600 mb-2">Content</label>
                    <textarea id="newNoteContent" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter note content" rows="4" required></textarea>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition" onclick="closeAddNoteModal()">Cancel</button>
                    <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition" onclick="addNote()">Save</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function searchNotes() {
            const input = document.getElementById('searchNotes').value.toLowerCase();
            const noteList = document.getElementById('noteList').children;
            for (let i = 0; i < noteList.length; i++) {
                const title = noteList[i].querySelector('span').textContent.toLowerCase();
                noteList[i].style.display = title.includes(input) ? '' : 'none';
            }
        }

        function selectNote(title, content) {
            document.getElementById('noteTitle').innerText = title;
            document.getElementById('noteContent').innerText = content;
        }

        function openAddNoteModal() {
            document.getElementById('addNoteModal').classList.remove('hidden');
        }

        function closeAddNoteModal() {
            document.getElementById('addNoteModal').classList.add('hidden');
            document.getElementById('newNoteTitle').value = '';
            document.getElementById('newNoteContent').value = '';
        }

        function addNote() {
            const title = document.getElementById('newNoteTitle').value;
            const content = document.getElementById('newNoteContent').value;
            if (title && content) {
                const noteList = document.getElementById('noteList');
                const li = document.createElement('li');
                li.className = 'p-3 bg-blue-50 rounded-md cursor-pointer hover:bg-blue-100 transition';
                li.innerHTML = `<span class="text-gray-900">${title}</span><span class="text-sm text-gray-500 block">Created: ${new Date().toISOString().split('T')[0]}</span>`;
                li.onclick = () => selectNote(title, content);
                noteList.prepend(li);
                closeAddNoteModal();
            }
        }

        function editNote() {
            alert('Edit functionality to be implemented.');
        }

        function deleteNote() {
            alert('Delete functionality to be implemented.');
        }
    </script>
</x-layout>