<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.0/codemirror.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.0/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.0/mode/python/python.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="styles.css" />
<?php
include "connection.php";
$isstudent = isset($_POST["id"]);
if ($isstudent) {
    echo $_POST["id"];
    echo "<div class='inform'>";
    $id = $_POST["id"];
    $sql = "SELECT Name FROM college WHERE Id = '$id'";
    $result = mysqli_query($conn, $sql); // Assuming you have a valid database connection
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        $name = $row['Name'];
        echo "<div>ID No : " . $id . "&nbsp&nbsp&nbsp&nbsp</div>";
        echo "<div>Name &nbsp &nbsp: " . $name . '</div>';
    } else {
        echo "Invalid Id Number";
    }
    echo "</div>";
}
else{
    echo "<div>Error Bad GateWay</div>";
}
?>
<?php
if ($isstudent) {
    $questions = [
        "Python program to add two numbers",
        "Maximum of two numbers in Python",
        "Python Program for factorial of a number",
        "Python Program for simple interest",
        "Python Program for compound interest",
        "Python Program to check Armstrong Number",
        "Python Program for Program to find area of a circle",
        "Python program to print all Prime numbers in an Interval",
        "Python program to check whether a number is Prime or not",
        "Python Program for n-th Fibonacci number",
        "Python Program for How to check if a given number is Fibonacci number?",
        "Python Program for n\’th multiple of a number in Fibonacci Series",
        "Program to print ASCII Value of a character",
        "Python Program for Sum of squares of first n natural numbers",
        "Python Program for cube sum of first n natural numbers"
    ];
    $paper = '<div class="paper" id="paper{qnum}">
    <div class="questions">
        <div class="question qtitle">{qnum}</div>
        <div class="question qdes">{qdes}</div>
    </div>
    <div class="code">
        <textarea  data-qnum="q{qnum}" class="code-area" rows="15">{answer123}</textarea>
    </div>
</div>';

    $sql = "SELECT * FROM questions  WHERE Id = '$id'";
    $result = mysqli_query($conn, $sql); // Assuming you have a valid database connection
    $answer = $result->fetch_assoc();
    if ($answer) {
        $count = 1;
        foreach ($questions as $question) {
            if (isset($answer["q" . $count])) {
                $newString = str_replace(["{qnum}", "{qdes}", "{qnum+1}", "{qnum-1}", "{answer123}"], [$count, $question, $count + 1, $count - 1, $answer["q" . $count]], $paper);
                echo $newString;
                $count += 1;
            } else {
                break;
            }
        }
    } else {
        echo "Student Not Written Test";
    }
}
?>


<script>
    $(document).ready(function () {
        $(document).ready(function () {
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
        })
    })
</script>