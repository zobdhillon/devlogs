// ─── Toast ───────────────────────────────────────────────────────────────────

export function showToast(message, type = "success") {
    window.dispatchEvent(
        new CustomEvent("show-toast", {
            detail: { message, type },
        }),
    );
}

// ─── DOM ─────────────────────────────────────────────────────────────────────

export function fadeRemove(id) {
    const el = document.getElementById(id);
    if (!el) return;
    el.style.transition = "opacity 0.3s, transform 0.3s";
    el.style.opacity = "0";
    el.style.transform = "translateX(8px)";
    setTimeout(() => el.remove(), 300);
}

// ─── Delete ──────────────────────────────────────────────────────────────────

export function deleteRecord(resource, id) {
    axios
        .post(`/${resource}/${id}`, { _method: "DELETE" })
        .then(() => {
            fadeRemove(`${resource.slice(0, -1)}-${id}`);
            showToast(`${resource.slice(0, -1)} deleted`);
        })
        .catch(() => showToast("Something went wrong", "error"));
}

// ─── Goal toggle ─────────────────────────────────────────────────────────────

export function toggleGoal(id) {
    axios
        .post(`/goals/${id}`, { toggle_complete: 1, _method: "PUT" })
        .then(({ data }) => {
            if (!data.ok) return;

            const completed = data.completed;
            const btn =
                document.getElementById(`goal-toggle-${id}`) ??
                document.getElementById(`dash-goal-toggle-${id}`);
            const title =
                document.getElementById(`goal-title-${id}`) ??
                document.getElementById(`dash-goal-title-${id}`);

            if (!btn || !title) return;

            if (completed) {
                btn.className =
                    "flex h-4 w-4 flex-shrink-0 items-center justify-center rounded border border-accent bg-accent transition-colors";
                btn.innerHTML = `<svg class="h-2.5 w-2.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                 </svg>`;
            } else {
                btn.className =
                    "flex h-4 w-4 flex-shrink-0 items-center justify-center rounded border border-accent/40 bg-transparent transition-colors";
                btn.innerHTML = "";
            }

            title.className = completed
                ? "flex-1 text-sm text-gray-400 line-through"
                : "flex-1 text-sm text-gray-200";
            title.style.color = "";
            title.style.textDecoration = "";

            showToast(completed ? "Goal completed" : "Goal reopened");
        })
        .catch(() => showToast("Something went wrong", "error"));
}
