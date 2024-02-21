const r = gsap.timeline({ repeat: -1 });
const o = gsap.timeline({ repeat: -1 });
const h = gsap.timeline({ repeat: -1 });

r.to("#app", {
    "--r": "180deg",
    "--p": "0%",
    duration: 9,
    ease: "sine.in"
});
r.to("#app", {
    "--r": "360deg",
    "--p": "100%",
    duration: 9,
    ease: "sine.out"
});
o.to("#app", {
    "--o": 1,
    duration: 2.5,
    ease: "power1.in"
});
o.to("#app", {
    "--o": 0,
    duration: 2.5,
    ease: "power1.out"
});

h.to("#app", {
    "--h": "100%",
    duration: 2.5,
    ease: "sine.in"
});
h.to("#app", {
    "--h": "50%",
    duration: 2.5,
    ease: "sine.out"
});
h.to("#app", {
    "--h": "0%",
    duration: 2.5,
    ease: "sine.in"
});
h.to("#app", {
    "--h": "50%",
    duration: 2.5,
    ease: "sine.out"
});
