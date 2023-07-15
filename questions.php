<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.0/codemirror.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.0/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.0/mode/python/python.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="styles.css" />
<script src='scripts.js'></script>


<?php
include "connection.php";
session_start();
$isreg = isset($_SESSION["id"]);
if ($isreg) {
    echo "<div class='inform'>";
    $id = $_SESSION["id"];
    $sql = "SELECT Name FROM college WHERE Id = '$id'";
    $result = mysqli_query($conn, $sql); // Assuming you have a valid database connection
    $name = mysqli_fetch_assoc($result)['Name'];
    $sql = "SELECT * FROM questions  WHERE Id = '$id'";
    $result = mysqli_query($conn, $sql); // Assuming you have a valid database connection
    $answer = mysqli_fetch_assoc($result);
    echo "<div>ID No : " . $id . "&nbsp&nbsp&nbsp&nbsp</div>";
    echo "<div>Name &nbsp &nbsp: " . $name . '</div>';
    echo '<div id class="submitButton">Save &nbsp&nbsp<svg class="svg-icon" style="width: 1em; height: 1em;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M165.840081 127.921872h608.774771l121.254934 121.254934v608.774771c0 20.834181-17.084028 37.91821-37.918209 37.918209H165.840081c-20.834181 0-37.91821-17.084028-37.918209-37.918209V165.840081c0-20.834181 17.084028-37.91821 37.918209-37.918209z" fill="#01579B" /><path d="M284.803255 127.921872h454.39349V318.76297c0 25.626043-20.834181 46.668566-46.668566 46.668566H331.471821c-25.626043 0-46.668566-20.834181-46.668566-46.668566V127.921872zM743.155239 896.078128H280.844761V654.818311c0-27.917803 22.709257-50.62706 50.62706-50.62706h361.2647c27.917803 0 50.62706 22.709257 50.62706 50.62706l-0.208342 241.259817z" fill="#0277BD" /><path d="M299.803866 127.921872h424.392268V318.76297c0 17.29237-14.167243 31.667955-31.667955 31.667956H331.471821c-17.29237 0-31.667955-14.167243-31.667955-31.667956V127.921872zM299.803866 896.078128h424.392268V654.818311c0-17.29237-14.167243-31.667955-31.667955-31.667955H331.471821c-17.29237 0-31.667955 14.167243-31.667955 31.667955v241.259817z" fill="#EEEEEE" /><path d="M572.731638 127.921872h93.128789v181.882401h-93.128789z" fill="#424242" /><path d="M360.431333 724.612818h303.137334v19.167446H360.431333zM360.431333 808.991251h303.137334v19.167447H360.431333z" fill="#757575" /></svg></div>';
    echo "</div>";
}
?>
<?php
if ($isreg) {
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
    <div class="nxtprev">
        {prev-button}
        {next-button}
    </div>
</div>
';

    $count = 1;
    $prev_button = '<div class="btn" data-next-div = "#paper{qnum-1}">Prev</div>';
    $next_button = '<div class="btn" data-next-div = "#paper{qnum+1}">Next</div>';
    foreach ($questions as $question) {
        if (isset($answer["q" . $count])) {
            if ($count == 1) {
                $newString = str_replace(["{prev-button}", "{next-button}"], ["", $next_button], $paper);
            } else if ($count == count($answer) - 2) {
                $newString = str_replace(["{prev-button}", "{next-button}"], [$prev_button, ""], $paper);
            } else {
                $newString = str_replace(["{prev-button}", "{next-button}"], [$prev_button, $next_button], $paper);
            }
            $newString = str_replace(["{qnum}", "{qdes}", "{qnum+1}", "{qnum-1}", "{answer123}"], [$count, $question, $count + 1, $count - 1, $answer["q" . $count]], $newString);
            echo $newString;
            $count += 1;
        } else {
            break;
        }
    }
}
// If youser not Register
else {
    echo "Yes";
    header("Location: registration.php");
} ?>