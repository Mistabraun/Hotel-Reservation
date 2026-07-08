<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form action="post.php" method="post" id="loginForm">
        <input type="text" name="username" id="username" placeholder="Input username">
        <input type="text" name="password" id="password" , placeholder="Input password">
        <button type="submit">Submit</button>
    </form>

    <script>
        const form = document.getElementById("loginForm")
        form.addEventListener("submit", async function(e) {
            e.preventDefault();
            const response = await fetch("test.php", {
                method: "post",
                body: new FormData(form)
            })

            const result = await response.json()

            console.log(result)
        })
    </script>
</body>

</html>