import "./bootstrap";
import Alpine from "alpinejs";

import { fadeRemove, deleteRecord, toggleGoal, showToast } from "./devlogs.js";

// ─── Globals — callable from blade templates ──────────────────────────────────
window.fadeRemove = fadeRemove;
window.deleteRecord = deleteRecord;
window.toggleGoal = toggleGoal;
window.showToast = showToast;

// ─── Alpine: confirm delete modal ────────────────────────────────────────────
Alpine.data("confirmModal", () => ({
    show: false,
    title: "",
    callback: null,

    open({ title, callback }) {
        this.title = title;
        this.callback = callback;
        this.show = true;
    },

    confirm() {
        this.show = false;
        if (this.callback) this.callback();
    },
}));

// ─── Alpine: toast notification ───────────────────────────────────────────────
Alpine.data("toastNotification", () => ({
    visible: false,
    message: "",
    type: "success",
    timer: null,

    show({ message, type = "success" }) {
        this.message = message;
        this.type = type;
        this.visible = true;

        // reset timer so rapid toasts don't conflict
        clearTimeout(this.timer);
        this.timer = setTimeout(() => (this.visible = false), 3000);
    },
}));

window.Alpine = Alpine;
Alpine.start();
