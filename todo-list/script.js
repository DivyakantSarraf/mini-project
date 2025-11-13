// -----------------------------------------------------
// 1. Detect current page and set storage key
// -----------------------------------------------------
let storageKey = "todos_daily";

const path = window.location.pathname;

if (path.includes("weekly")) {
    storageKey = "todos_weekly";
} 
else if (path.includes("monthly")) {
    storageKey = "todos_monthly";
}
else if (path.includes("yearly")) {
    storageKey = "todos_yearly";
}

// Load existing tasks
const saved = localStorage.getItem(storageKey);
const todos = saved ? JSON.parse(saved) : [];

// -----------------------------------------------------
// 2. Select DOM elements
// -----------------------------------------------------
const list = document.getElementById("todo-list");

const openFormBtn = document.getElementById("open-form-btn");
const taskForm = document.getElementById("task-form");
const saveTaskBtn = document.getElementById("save-task-btn");
const cancelTaskBtn = document.getElementById("cancel-task-btn");
const sortDateBtn = document.getElementById("sort-date-btn");
const clearAllBtn = document.getElementById("clear-all-btn");


// -----------------------------------------------------
// 3. Show Add Task form
// -----------------------------------------------------
if (openFormBtn) {
    openFormBtn.addEventListener("click", () => {
        taskForm.style.display = "block";
    });
}

// Hide Add Task form
if (cancelTaskBtn) {
    cancelTaskBtn.addEventListener("click", () => {
        taskForm.style.display = "none";
        clearForm();
    });
}

// -----------------------------------------------------
// 4. Save new task
// -----------------------------------------------------
if (saveTaskBtn) {
    saveTaskBtn.addEventListener("click", () => {
        const title = document.getElementById("task-title").value.trim();
        const date = document.getElementById("task-date").value;

        if (!title) {
            alert("Task title cannot be empty!");
            return;
        }

        todos.push({
        title,
        dueDate: date || "No date",
        completed: false  
        });


        saveTodos();
        render();
        clearForm();
        taskForm.style.display = "none";
    });
}

// -----------------------------------------------------
// 5. Sort tasks by due date
// -----------------------------------------------------
if (sortDateBtn) {
    sortDateBtn.addEventListener("click", () => {
        const withDate = todos.filter(t => t.dueDate !== "No date");
        const withoutDate = todos.filter(t => t.dueDate === "No date");

        withDate.sort((a, b) => new Date(a.dueDate) - new Date(b.dueDate));

        const sorted = [...withDate, ...withoutDate];

        todos.length = 0;
        sorted.forEach(t => todos.push(t));

        saveTodos();
        render();
    });
}

// -----------------------------------------------------
//  Clear All Tasks
// -----------------------------------------------------
if (clearAllBtn) {
    clearAllBtn.addEventListener("click", () => {
        if (confirm("Are you sure you want to delete ALL tasks?")) {
            todos.length = 0;  // empty array
            saveTodos();
            render();
        }
    });
}


// -----------------------------------------------------
// 6. Save to localStorage
// -----------------------------------------------------
function saveTodos() {
    localStorage.setItem(storageKey, JSON.stringify(todos));
}

// -----------------------------------------------------
// 7. Clear form fields
// -----------------------------------------------------
function clearForm() {
    const t = document.getElementById("task-title");
    const d = document.getElementById("task-date");

    if (t) t.value = "";
    if (d) d.value = "";
}



// -----------------------------------------------------
// 8. Render tasks (Hover Details + Edit Mode + Delete)
// -----------------------------------------------------
function render() {
    list.innerHTML = "";

    todos.forEach((task, index) => {
        const li = document.createElement("li");
        li.className = "todo-item";

        // --- Checkbox ---
        const check = document.createElement("input");
        check.type = "checkbox";
        check.checked = task.completed;

        check.addEventListener("change", () => {
            task.completed = check.checked;
            saveTodos();
            render();
        });

        // --- Title ---
        const titleDiv = document.createElement("div");
        titleDiv.className = "task-title";
        titleDiv.textContent = task.title;

        if (task.completed) {
            titleDiv.style.textDecoration = "line-through";
            titleDiv.style.opacity = "0.6";
        }

        // --- Details ---
        const detailsDiv = document.createElement("div");
        detailsDiv.className = "task-details";
        detailsDiv.style.display = "none";
        detailsDiv.innerHTML = `<p><strong>Due:</strong> ${task.dueDate}</p>`;

        li.addEventListener("mouseenter", () => {
            detailsDiv.style.display = "block";
        });

        li.addEventListener("mouseleave", () => {
            detailsDiv.style.display = "none";
        });

        // --- Buttons ---
        const btnDiv = document.createElement("div");
        const editBtn = document.createElement("button");
        const deleteBtn = document.createElement("button");

        editBtn.textContent = "Edit";
        deleteBtn.textContent = "Delete";

        btnDiv.appendChild(editBtn);
        btnDiv.appendChild(deleteBtn);

        // --- Edit MODE ---
        const editDiv = document.createElement("div");
        editDiv.style.display = "none";
        editDiv.innerHTML = `
            <input type="text" id="edit-title-${index}" value="${task.title}">
            <input type="date" id="edit-date-${index}" value="${task.dueDate !== 'No date' ? task.dueDate : ''}">
            <br>
            <button id="save-${index}">Save</button>
            <button id="cancel-${index}">Cancel</button>
        `;

        editBtn.addEventListener("click", () => {
            titleDiv.style.display = "none";
            detailsDiv.style.display = "none";
            btnDiv.style.display = "none";
            editDiv.style.display = "block";
        });

        editDiv.querySelector(`#cancel-${index}`).addEventListener("click", () => {
            editDiv.style.display = "none";
            titleDiv.style.display = "block";
            btnDiv.style.display = "block";
        });

        editDiv.querySelector(`#save-${index}`).addEventListener("click", () => {
            const newTitle = document.getElementById(`edit-title-${index}`).value.trim();
            const newDate = document.getElementById(`edit-date-${index}`).value.trim();

            if (!newTitle) {
                alert("Title cannot be empty!");
                return;
            }

            todos[index].title = newTitle;
            todos[index].dueDate = newDate || "No date";

            saveTodos();
            render();
        });

        deleteBtn.addEventListener("click", () => {
            if (confirm("Delete this task?")) {
                todos.splice(index, 1);
                saveTodos();
                render();
            }
        });

        // Add everything to li
        li.appendChild(check);
        li.appendChild(titleDiv);
        li.appendChild(detailsDiv);
        li.appendChild(btnDiv);
        li.appendChild(editDiv);

        list.appendChild(li);
    });
}

render();