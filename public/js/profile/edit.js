    const btns = document.querySelectorAll("button > svg")
    btns.forEach((btn) => {
        btn.addEventListener("click", (e) =>
        {
            const button = e.target.closest("button");
            let input = button.parentElement.querySelector("input");
            console.log(input);
            // document.createElement().closest("")
            input.disabled = !input.disabled;
        })
    })