const $ = (s) => document.querySelector(s),
    tn = $("#toast");
function toast(m) {
    tn.textContent = m;
    tn.classList.add("on");
    clearTimeout(toast.t);
    toast.t = setTimeout(() => tn.classList.remove("on"), 2200);
}
// theme
const rt = document.documentElement;
$("#theme").onclick = () => {
    const d =
        rt.dataset.theme === "dark" ||
        (!rt.dataset.theme &&
            matchMedia("(prefers-color-scheme:dark)").matches);
    rt.dataset.theme = d ? "light" : "dark";
    $("#theme").innerHTML = d
        ? '<svg class="i"><use href="#i-sun"/></svg>'
        : '<svg class="i"><use href="#i-moon"/></svg>';
};
// hero carousel
if ($("#car")) {
    const S = [
        ["/img/hero/Fotobd.jpeg", "Mahasiswa Kreatif"],
        ["/img/hero/hero-2.jpg", "Kuliner Kampus"],
        ["/img/hero/hero-3.jpg", "Digital & Jasa"],
        ["/img/hero/hero-4.jpg", "Craft & Fashion"],
    ];
    const tr = $("#track"),
        car = $("#car"),
        dots = $("#dots");
    let i = 0,
        ax;
    tr.innerHTML = S.map(
        (s) =>
            `<div class="slide" style="background-image:url('${s[0]}')"><span class="cap">${s[1]}</span></div>`,
    ).join("");
    dots.innerHTML = S.map((_, k) => `<i data-k="${k}"></i>`).join("");

    function go(n) {
        i = (n + S.length) % S.length;
        tr.style.transform = `translateX(${-i * 100}%)`;
        [...dots.children].forEach((d, k) => d.classList.toggle("on", k === i));
        $("#cnt").textContent = `${i + 1} / ${S.length}`;
    }
    dots.onclick = (e) => e.target.dataset.k && (go(+e.target.dataset.k), rs());
    $("#pv").onclick = () => {
        go(i - 1);
        rs();
    };
    $("#nx").onclick = () => {
        go(i + 1);
        rs();
    };
    let sx = 0,
        dx = 0,
        dn = false,
        w = 1;
    car.addEventListener("pointerdown", (e) => {
        dn = true;
        sx = e.clientX;
        dx = 0;
        w = car.offsetWidth;
        tr.classList.add("nd");
        car.classList.add("drag");
        car.setPointerCapture(e.pointerId);
        clearInterval(ax);
    });
    car.addEventListener("pointermove", (e) => {
        if (!dn) return;
        dx = e.clientX - sx;
        tr.style.transform = `translateX(${-i * 100 + (dx / w) * 100}%)`;
    });
    const end = () => {
        if (!dn) return;
        dn = false;
        tr.classList.remove("nd");
        car.classList.remove("drag");
        if (dx < -w * 0.15) go(i + 1);
        else if (dx > w * 0.15) go(i - 1);
        else go(i);
        rs();
    };
    car.addEventListener("pointerup", end);
    car.addEventListener("pointercancel", end);
    document.addEventListener("keydown", (e) => {
        if (e.key === "ArrowLeft") go(i - 1);
        if (e.key === "ArrowRight") go(i + 1);
    });
    function rs() {
        clearInterval(ax);
        ax = setInterval(() => go(i + 1), 5000);
    }
    go(0);
    rs();
}

document
    .querySelector(".burger")
    ?.addEventListener("click", () => $("#links").classList.toggle("open"));
document.querySelectorAll(".tabs[data-t]").forEach((t) =>
    t.addEventListener("click", (e) => {
        const b = e.target.closest(".tab");
        if (!b) return;
        t.querySelectorAll(".tab").forEach((x) =>
            x.classList.toggle("on", x === b),
        );
        const f = b.dataset.f;
        document
            .querySelectorAll(t.dataset.t)
            .forEach((i) => (i.hidden = f !== "*" && i.dataset.cat !== f));
    }),
);
document.querySelectorAll("form[data-toast]").forEach((f) =>
    f.addEventListener("submit", (e) => {
        e.preventDefault();
        toast(f.dataset.toast);
        f.reset();
    }),
);
document.querySelector(".save")?.addEventListener("click", (e) => {
    const b = e.currentTarget;
    b.classList.toggle("on");
    toast(
        b.classList.contains("on")
            ? "Produk disimpan"
            : "Produk dihapus dari simpanan",
    );
});
