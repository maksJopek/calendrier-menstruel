"use strict";
document.body.onkeydown = e => {
    if (e.key === "Escape") {
        INPUT.value = "";
        INPUT.dataset.id = "";
        MENU.style.display = "none";
    }
};
const MENU = document.getElementsByTagName("div")[0];
const INPUT = document.getElementsByTagName("input")[0];
const IMG = document.getElementsByTagName("img")[0];
const MAP = document.getElementsByTagName("map")[0];
const ERR = document.getElementsByTagName("div")[1];
const Y_DATA = JSON.parse(document.getElementsByTagName("span")[0].innerHTML);
const ORIG_SRC = IMG.src;
function showMenu(id, value) {
    if (value !== -1 && value !== null && value !== undefined)
        INPUT.value = value.toString();
    INPUT.dataset.id = id.toString();
    MENU.style.display = "block";
}
async function menuClick(action) {
    if (action !== "cancel" && (parseFloat(INPUT.value) < Y_DATA[0] || parseFloat(INPUT.value) > Y_DATA[Y_DATA.length - 1])) {
        ERR.innerHTML = "Too small or to big number";
        return;
    }
    if (action !== "cancel") {
        let data;
        if (action === "save")
            data = parseFloat(INPUT.value);
        else if (action === "condition")
            data = -1;
        else if (action === "null")
            data = null;
        else
            throw new Error("New chart data has unknown type");
        await fetch("/php/save-data.php", {
            method: "POST",
            headers: {
                Accept: "application/json",
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ data, id: INPUT.dataset.id }),
        });
        // IMG.src = `${IMG.src.split('?')[0]}?${Date.now()}`;
        IMG.src = ORIG_SRC + "cache=" + Date.now();
        setNewImgMap();
    }
    INPUT.value = "";
    INPUT.dataset.id = "";
    MENU.style.display = "none";
}
async function setNewImgMap() {
    MAP.innerHTML = await (await fetch("/php/get-img-map.php")).text();
}
function input() {
    const v = INPUT.value;
    if (!/[\d\.]/.test(v[v.length - 1]) || v.split('.').length > 2) {
        console.log(2);
        INPUT.value = v.substr(0, v.length - 1);
    }
}
