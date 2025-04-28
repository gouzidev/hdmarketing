<script>
    const pwIcon = document.querySelector("#togglePasswordIcon")
    pwIcon.addEventListener("click", (e) => 
    {
        const input = e.target.parentElement.querySelector("input");
        console.log(pwIcon)
        if (input.type == "password")
        {
            pwIcon.src = pwIcon.src.replace("hide", "show")
            input.type = "text"
        }
        else
        {
            pwIcon.src = pwIcon.src.replace("show", "hide")
            input.type = "password"
        }
    })
</script>