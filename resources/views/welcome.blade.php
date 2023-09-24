<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>    
        <!-- Bootstrap CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
        <script src="{{ asset('js/quiz.js') }}" defer></script>           
    </head>
    
    <body>
        <div id="welcome">
            <form>
                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        <label for="inputPassword6" class="col-form-label">Enter Name:</label>
                    </div>
                    <div class="col-auto">
                        <input type="text" name="name" id="name" class="form-control" aria-describedby="passwordHelpInline">
                    </div>
                    <div class="col-auto">
                        <button type="button" id="submit" class="btn btn-secondary">View Quiz</button>
                    </div>
                </div>
            </form>
        </div>
        <div id="quiz">
            <input type="hidden" id="question_number" name="question_number" value="1">
            <p id="question"></p>
            <input type="radio" id="op1_input"  name="options" value="HTML">
             <label id="op1" for="html">HTML</label><br>
             <input type="radio" id="op2_input"  name="options" value="CSS">
             <label for="css" id="op2">CSS</label><br>
             <input type="radio" id="op3_input"  name="options" value="JavaScript">
             <label for="javascript" id="op3">JavaScript</label>
            <input type="radio" id="op4_input"  name="options" value="Jquery">
             <label for="javascript" id="op4">Jquery</label>
            
            <div class="col-auto">
            <button type="button" id="next" class="btn btn-secondary">Next</button>
            <button type="button" id="skip" class="btn btn-secondary">Skip</button>
            </div>
        </div>
        <div id="results">
            <table>
                <thead>
                    <th>UserName</th>
                    <th>Correct Answers</th>
                    <th>Wrong Answers</th>
                    <th>Skipped Answers</th>
                </thead>
                <tbody>
                    <td id="user"></td>
                    <td id="correct"></td>
                    <td id="wrong"></td>
                    <td id="skipped"></td>
                </tbody>
            </table>
        </div>    
    </body>
</html>
