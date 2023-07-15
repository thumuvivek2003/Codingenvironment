$(document).ready(function () {
    // Handling Code Environment
    const ans = {};
    const codeTextAreas = document.querySelectorAll(".code-area");
    codeTextAreas.forEach(function (codeTextArea) {
        const editor = CodeMirror.fromTextArea(codeTextArea, {
            lineNumbers: true,
            mode: "python"
        });
        var enteredText = editor.getValue();
        const codeArea = editor.getWrapperElement().previousElementSibling;
        qnum = codeArea.getAttribute("data-qnum");
        ans[qnum] = enteredText;
        editor.on("change", function () {
            var enteredText = editor.getValue();
            const codeArea = editor.getWrapperElement().previousElementSibling;
            qnum = codeArea.getAttribute("data-qnum");
            ans[qnum] = enteredText;
            // CodeMirror.autoLoadMode(editor, "python");
        });
    });
    var papers = $(".paper");
    var buttons = $(".btn");

    if (papers.length > 0) {
        papers.css("display", "none");
        $(papers[0]).fadeIn("slow");
    }


    // Handling next prev button
    $(".btn").on("click", function () {
        var nextDiv = $($(this).data("next-div"));
        if (nextDiv.length) {
            $($(this).closest(".paper")).hide("speed", function () {
                nextDiv.show("speed");
            });
        }
    });


    // Handling Sumbmit Button
    $(".submitButton").each(function () {
        $(this).on("click", function () {
            // Make an AJAX request to send textareaData to the server
            $.ajax({
                url: "inseting.php",
                method: "POST",
                data: ans,
                success: function (response) {
                    // Handle successful response from the server here
                    alert(response);
                    // Clear the textarea after successful submission if needed
                },
                error: function (xhr, status, error) {
                    // Handle errors or failed requests here
                }
            });
        });
    });
});