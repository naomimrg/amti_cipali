import React from "react";
import { render } from "react-dom";
import CreativeGridBackground from "./components/CreativeGridBackground.jsx";
import "../css/app.css";

// cari mount di Blade
const mount = document.getElementById("bg-root");
if (mount) {
    const raw = mount.dataset.images || "[]";
    let images = [];
    try { images = JSON.parse(raw); } catch { }
    render(<CreativeGridBackground images={images} />, mount);
}
