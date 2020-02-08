<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Book List</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
    
    </head>
    <body>
        <style>
            body {
                margin: 0;
                display: flex;
                flex-direction: column;
                min-height: 100vh;
            }
            main {
              /* Чтобы занимал оставшееся пространство */
                flex-grow: 1;
            }
            footer {
              /* Чтобы footer не уменьшался */
                flex-shrink: 0;
            }
        </style>
    
    <nav class="m-1 navbar navbar-expand-lg navbar-dark bg-primary">
       <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Book List</a>
                </li>

            </ul>
        </div>
    </nav>
    <main>
