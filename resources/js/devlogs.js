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
        .delete(`/${resource}/${id}`)
        .then(() => {
            fadeRemove(`${resource.slice(0, -1)}-${id}`);
            showToast(`${resource.slice(0, -1)} deleted`);
        })
        .catch(() => showToast("Something went wrong", "error"));
}

// ─── Goal toggle ─────────────────────────────────────────────────────────────

export function toggleGoal(id) {
    axios
        .put(`/goals/${id}`, { toggle_complete: 1 })
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
                btn.style.background = "#7c3aed";
                btn.style.borderColor = "#7c3aed";
                btn.style.boxShadow = "0 0 8px rgba(124,58,237,0.4)";
                btn.innerHTML = `<svg class="w-3 h-3" fill="none" stroke="white" viewBox="0 0 24 24" stroke-width="3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                 </svg>`;
            } else {
                btn.style.background = "transparent";
                btn.style.borderColor = "rgba(168,85,247,0.4)";
                btn.style.boxShadow = "none";
                btn.innerHTML = "";
            }

            title.style.color = completed ? "#8b7fa8" : "#f0ece8";
            title.style.textDecoration = completed ? "line-through" : "none";

            showToast(completed ? "Goal completed ✓" : "Goal reopened");
        })
        .catch(() => showToast("Something went wrong", "error"));
}
