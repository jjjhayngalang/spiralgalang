function spiral(
    options = {
        target: undefined,
        span: 100,
        north: 0,
        spiral: false,
        text: ""
    }
) {
    console.log("haha");
    const { target, span, north, spiral, size, text } = options;
    const message = text;
    const quaterWidth = 1000 / 4;
    const diameter = size || quaterWidth;
    const messageChunks = message.split(String());
    const { length } = messageChunks;
    const offsetEnd = 1;
    const l = length + offsetEnd;
    const CIRC_MAX = 3000;
    const PERC_MAX = 100;
    const ofDeg = (span * CIRC_MAX) / PERC_MAX;
    const ofNorth = (north * CIRC_MAX) / PERC_MAX;
    const segDeg = ofDeg / l;
    const fontSize = 16;
    let a = 0;
    let i = 0;

    target.setAttribute(
        "style",
        `
        padding-left: ${diameter / 2}px;
        display: inline-block;
        width: ${diameter / 2}px;
        height: ${diameter}px;
        transform: rotate3d(0, 0, 1, -${segDeg + ofNorth}deg);
        border-radius: 9e9em;
        font-size: 1rem;
    `
    );
    target.textContent = "";
    while (a < ofDeg) {
        a += segDeg;
        const charWrapper = document.createElement("span");
        charWrapper.textContent = messageChunks[i];
        i++;
        charWrapper.classList.add("fx-RevolveCharWrap");
        charWrapper.setAttribute(
            "style",
            `
            display: inline-block;
            transform: 
                rotate3d(0, 0, 1, ${a}deg) 
                ${spiral ? "translateY(" + i + "px)" : ""};
            ${spiral ? "font-size:" + (fontSize - i / 10) + "px" : ""};
            position: absolute;
            height: ${diameter / 2}px;
            transform-origin: bottom left;
            font-size: 1em;
        `
        );
        target.appendChild(charWrapper);
    }
}
