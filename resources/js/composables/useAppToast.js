import { useToast } from "primevue/usetoast";

export function useAppToast() {
    const toast = useToast();

    const showSuccess = (detail) => {
        toast.add({
            severity: "success",
            summary: "Success",
            detail: detail,
            life: 3000, // Durasi terpusat
        });
    };

    const showError = (detail) => {
        toast.add({
            severity: "error",
            summary: "Error",
            detail: detail,
            life: 3000,
        });
    };

    return { showSuccess, showError };
}
