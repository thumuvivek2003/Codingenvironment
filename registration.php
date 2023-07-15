<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<div class="reg-card">
    <div id="idtitle">Enter ID Number </div>
    <div id="down">
        <input id="idnum" name="idnum" value="S190783"/>
        <button id="submit">Submit</button>
    </div>
</div>
<style>
    :root {
        --body: #F8F1F1;
        --reg-card: #F5F5F5;
        --down: #DAE2F8;

        /* --body:#001C30; */
        /* --reg-card:#FBFFDC; */
        /* --down:#D0F5BE */
    }

    * {
        /* border:1px black solid; */
    }

    body {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: var(--body);
    }

    input {
        text-align: center;
        outline: none;
        border: none;

    }

    #idtitle {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 25px;
        font-weight: 300;
        height: 23%;
        width: 100%;
        text-align: center;
        text-transform: uppercase;
    }

    .reg-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 300px;
        height: 300px;
        border-radius: 8px;
        background-color: var(--reg-card);
        border: 0.1pt solid rgba(0, 0, 0, 0.3);
        box-shadow: rgba(0, 0, 0, 0.2) 2.95px 2.95px 5.3px;
    }

    #idnum {
        width: 90%;
        height: 15%;
        border-radius: 5px;
        border: 0.1pt solid rgba(0, 0, 0, 0.3);
        box-shadow: rgba(0, 0, 0, 0.2) 2.95px 2.95px 5.3px;
    }

    #submit {
        color: white;
        letter-spacing: 1px;
        font-size: 20px;
        width: 90%;
        height: 15%;
        border: 1px black solid;
        border-radius: 5px;
        cursor: pointer;
        background-color: #071952;

    }

    #down {
        display: flex;
        flex-direction: column;
        align-items: center;
        height: 70%;
        width: 90%;
        justify-content: space-evenly;
        box-shadow: rgba(0, 0, 0, 0.2) 2.95px 2.95px 2.3px;
        /* border: 0.5px black solid; */
        border-radius: 5px;
        background-color: var(--down);

    }


    .overlay {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.7);
        transition: opacity 500ms;
        visibility: hidden;
        opacity: 0;
    }

    .overlay:target {
        visibility: visible;
        opacity: 1;
    }
</style>

<script>
    $("#submit").on("click", function () {
        var id = $('input[name="idnum"]').val().toUpperCase();
        console.log(id);
        if (/^S19\d{4}$/.test(id)) {
            // Make an AJAX request to send textareaData to the server
            $.ajax({
                url: "register.php",
                method: "POST",
                data: { id:id },
                success: function (response) {
                    // Handle successful response from the server here
                    console.log(response);
                    if (response == "202") {
                        window.location.href="questions.php"
                    }
                    else if(response=="404"){
                        alert("Student not Found");
                    }
                    // console.log(response);
                },
                error: function (xhr, status, error) {
                    // Handle errors or failed requests here
                    console.error(error);
                }
            });
        }
        else {

            alert("Invalid Id");

        }
    });
</script>