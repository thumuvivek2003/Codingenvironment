<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="jBox-master/dist/jBox.min.css">
    <style>
    </style>
</head>
<body>

<button class="my-button">Click Me</button>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="jBox-master/dist/jBox.min.js"></script>
<script>
    $(document).ready(function () {
        new jBox('Modal', {
            attach: '.my-button',
            content: 'This is a pop-up box!',
            draggable: true,
            dragOver: true,
            repositionOnOpen: false,
            fixed: false,
        });
    });
</script>

</body>
</html> 