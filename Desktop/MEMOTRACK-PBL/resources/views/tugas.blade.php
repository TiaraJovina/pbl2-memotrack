@php
    $role = 'dosen'; // Change to 'mahasiswa' to test student view
@endphp

<x-layout title="Tasks" role="{{$role}}">
    <!-- Tasks Header -->
    <header class="mb-8">
        <h2 class="text-3xl font-bold text-gray-900">Tasks</h2>
        <p class="text-gray-600 mt-2">{{ $role === 'dosen' ? 'Create and manage course tasks.' : 'View and submit your assignments.' }}</p>
    </header>

    <!-- Tasks Layout -->
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Task List Section -->
        <div class="bg-white p-6 rounded-lg shadow-md lg:col-span-2">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Task List</h3>
                @if($role === 'dosen')
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition" onclick="openAddTaskModal()">Add Task</button>
                @endif
            </div>
            <input type="text" id="searchTasks" placeholder="Search tasks..." class="w-full px-4 py-2 mb-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" oninput="searchTasks()">
            <ul id="taskList" class="space-y-2">
                <li class="p-3 bg-blue-50 rounded-md cursor-pointer" onclick="selectTask('Tugas Matematika', 'Solve chapter 5 exercises. Due: 2025-04-25', '2025-04-25')">
                    <span class="text-gray-900 font-medium">Tugas Matematika</span>
                    <span class="text-sm text-gray-500 block">Due: 2025-04-25</span>
                </li>
                <li class="p-3 bg-blue-50 rounded-md cursor-pointer" onclick="selectTask('Tugas Bahasa', 'Write a 500-word essay on local culture. Due: 2025-04-27', '2025-04-27')">
                    <span class="text-gray-900 font-medium">Tugas Bahasa</span>
                    <span class="text-sm text-gray-500 block">Due: 2025-04-27</span>
                </li>
                <li class="p-3 bg-blue-50 rounded-md cursor-pointer" onclick="selectTask('Tugas IPA', 'Complete lab report on photosynthesis. Due: 2025-04-30', '2025-04-30')">
                    <span class="text-gray-900 font-medium">Tugas IPA</span>
                    <span class="text-sm text-gray-500 block">Due: 2025-04-30</span>
                </li>
            </ul>
        </div>

        <!-- Task Details Section -->
        <div class="bg-white p-6 rounded-lg shadow-md lg:col-span-1" style="background-image: linear-gradient(#e5e7eb 1px, transparent 1px); background-size: 100% 2rem;">
            <h3 id="taskTitle" class="text-xl font-semibold text-gray-900 mb-4 relative">
                Task Details
                <span class="absolute bottom-0 left-0 w-full h-1 bg-red-500" style="background-image: url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 10%22 preserveAspectRatio=%22none%22%3E%3Cpath d=%22M0 5 Q 25 0 50 5 T 100 5%22 stroke=%22%23ef4444%22 stroke-width=%222%22 fill=%22none%22/%3E%3C/svg%3E'); background-size: 100% 100%;"></span>
            </h3>
            <p id="taskContent" class="text-gray-600 leading-loose" style="line-height: 2rem;">Select a task from the list to view its details.</p>
            <div class="mt-4">
                @if($role === 'dosen')
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition" onclick="editTask()">Edit Task</button>
                    <button class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition ml-2" onclick="deleteTask()">Delete Task</button>
                @else
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition" onclick="openSubmitModal()">Submit Assignment</button>
                @endif
            </div>
        </div>
    </section>

    <!-- Add/Edit Task Modal (Dosen Only) -->
    @if($role === 'dosen')
        <div id="taskModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
            <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
                <h3 id="taskModalTitle" class="text-lg font-semibold text-gray-900 mb-4">Add New Task</h3>
                <form>
                    <div class="mb-4">
                        <label for="taskTitleInput" class="block text-gray-600 mb-2">Task Title</label>
                        <input type="text" id="taskTitleInput" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter task title" required>
                    </div>
                    <div class="mb-4">
                        <label for="taskDetailsInput" class="block text-gray-600 mb-2">Details</label>
                        <textarea id="taskDetailsInput" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter task details" rows="4" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="taskDueDate" class="block text-gray-600 mb-2">Due Date</label>
                        <input type="date" id="taskDueDate" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition" onclick="closeTaskModal()">Cancel</button>
                        <button type="button" id="saveTaskButton" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition" onclick="saveTask()">Save</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- Submit Assignment Modal (Mahasiswa Only) -->
    @if($role === 'mahasiswa')
        <div id="submitModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
            <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Submit Assignment</h3>
                <form>
                    <div class="mb-4">
                        <label for="submissionFiles" class="block text-gray-600 mb-2">Upload Files</label>
                        <input type="file" id="submissionFiles" multiple class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" accept=".pdf,.doc,.docx" onchange="previewFiles()">
                    </div>
                    <div id="filePreview" class="mb-4 space-y-2"></div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition" onclick="closeSubmitModal()">Cancel</button>
                        <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition" onclick="submitAssignment()">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <script>
        let selectedTaskTitle = null;
        let isEditing = false;

        function searchTasks() {
            const input = document.getElementById('searchTasks').value.toLowerCase();
            const taskList = document.getElementById('taskList').children;
            for (let i = 0; i < taskList.length; i++) {
                const title = taskList[i].querySelector('span').textContent.toLowerCase();
                taskList[i].style.display = title.includes(input) ? '' : 'none';
            }
        }

        function selectTask(title, content, dueDate) {
            selectedTaskTitle = title;
            document.getElementById('taskTitle').innerText = title;
            document.getElementById('taskContent').innerText = content;
        }

        function openAddTaskModal() {
            isEditing = false;
            document.getElementById('taskModalTitle').innerText = 'Add New Task';
            document.getElementById('taskTitleInput').value = '';
            document.getElementById('taskDetailsInput').value = '';
            document.getElementById('taskDueDate').value = '';
            document.getElementById('saveTaskButton').onclick = saveTask;
            document.getElementById('taskModal').classList.remove('hidden');
        }

        function openEditTaskModal() {
            if (!selectedTaskTitle) {
                alert('Please select a task to edit.');
                return;
            }
            isEditing = true;
            const selectedItem = Array.from(document.getElementById('taskList').children).find(
                li => li.querySelector('span').textContent === selectedTaskTitle
            );
            if (selectedItem) {
                document.getElementById('taskModalTitle').innerText = 'Edit Task';
                document.getElementById('taskTitleInput').value = selectedTaskTitle;
                document.getElementById('taskDetailsInput').value = document.getElementById('taskContent').innerText.split('Due: ')[0].trim();
                document.getElementById('taskDueDate').value = selectedItem.querySelector('.text-sm').textContent.replace('Due: ', '');
                document.getElementById('saveTaskButton').onclick = saveTask;
                document.getElementById('taskModal').classList.remove('hidden');
            }
        }

        function closeTaskModal() {
            document.getElementById('taskModal').classList.add('hidden');
            document.getElementById('taskTitleInput').value = '';
            document.getElementById('taskDetailsInput').value = '';
            document.getElementById('taskDueDate').value = '';
        }

        function saveTask() {
            const title = document.getElementById('taskTitleInput').value;
            const details = document.getElementById('taskDetailsInput').value;
            const dueDate = document.getElementById('taskDueDate').value;
            if (title && details && dueDate) {
                const taskList = document.getElementById('taskList');
                if (isEditing) {
                    const items = taskList.children;
                    for (let i = 0; i < items.length; i++) {
                        if (items[i].querySelector('span').textContent === selectedTaskTitle) {
                            items[i].innerHTML = `<span class="text-gray-900 font-medium">${title}</span><span class="text-sm text-gray-500 block">Due: ${dueDate}</span>`;
                            items[i].onclick = () => selectTask(title, `${details}. Due: ${dueDate}`, dueDate);
                            break;
                        }
                    }
                } else {
                    const li = document.createElement('li');
                    li.className = 'p-3 bg-blue-50 rounded-md cursor-pointer';
                    li.innerHTML = `<span class="text-gray-900 font-medium">${title}</span><span class="text-sm text-gray-500 block">Due: ${dueDate}</span>`;
                    li.onclick = () => selectTask(title, `${details}. Due: ${dueDate}`, dueDate);
                    taskList.prepend(li);
                }
                selectTask(title, `${details}. Due: ${dueDate}`, dueDate);
                closeTaskModal();
            }
        }

        function editTask() {
            openEditTaskModal();
        }

        function deleteTask() {
            if (!selectedTaskTitle) {
                alert('Please select a task to delete.');
                return;
            }
            if (confirm(`Are you sure you want to delete "${selectedTaskTitle}"?`)) {
                const taskList = document.getElementById('taskList').children;
                for (let i = 0; i < taskList.length; i++) {
                    if (taskList[i].querySelector('span').textContent === selectedTaskTitle) {
                        taskList[i].remove();
                        break;
                    }
                }
                document.getElementById('taskTitle').innerText = 'Task Details';
                document.getElementById('taskContent').innerText = 'Select a task from the list to view its details.';
                selectedTaskTitle = null;
            }
        }

        function openSubmitModal() {
            if (!selectedTaskTitle) {
                alert('Please select a task to submit.');
                return;
            }
            document.getElementById('filePreview').innerHTML = '';
            document.getElementById('submissionFiles').value = '';
            document.getElementById('submitModal').classList.remove('hidden');
        }

        function closeSubmitModal() {
            document.getElementById('submitModal').classList.add('hidden');
            document.getElementById('filePreview').innerHTML = '';
            document.getElementById('submissionFiles').value = '';
        }

        function previewFiles() {
            const files = document.getElementById('submissionFiles').files;
            const preview = document.getElementById('filePreview');
            preview.innerHTML = '';
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const fileType = file.name.split('.').pop().toLowerCase();
                let icon = '📄';
                if (fileType === 'pdf') icon = '📕';
                else if (['doc', 'docx'].includes(fileType)) icon = '📝';
                const div = document.createElement('div');
                div.className = 'flex items-center text-gray-600';
                div.innerHTML = `${icon} ${file.name}`;
                preview.appendChild(div);
            }
        }

        function submitAssignment() {
            const files = document.getElementById('submissionFiles').files;
            if (files.length > 0) {
                alert(`Submitted ${files.length} file(s) for "${selectedTaskTitle}".`);
                closeSubmitModal();
            } else {
                alert('Please select at least one file to submit.');
            }
        }
    </script>
</x-layout>








