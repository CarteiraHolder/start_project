
export function download(data, name) {
    const link = document.createElement("a");
    link.href = window.URL.createObjectURL(new Blob([data]));
    link.setAttribute("download", `${name}.xlsx`);
    document.body.appendChild(link);
    link.click();
}

export const headers = {
    responseType: "arraybuffer",
    headers: { "Content-Type": "blob" },
};