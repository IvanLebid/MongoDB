function storageFunction(key) {
    let oldData = localStorage.getItem(key);
    let checkData = oldData ? JSON.parse(oldData) : [];
    let updatedData = data.concat(checkData);
    localStorage.setItem(key, JSON.stringify(updatedData));
}
