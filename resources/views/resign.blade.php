<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
</head>
<body>
    <h1>Create</h1>
    <form action="" method="POST">
        <label for="emp">Employee Id & Name</label>
        <select name="employee_id">
            @foreach ($employees as $employee)
                <option value="{{ $employee->id }}">{{ $employee->emp_id }} - {{ $employee->emp_name }}</option>
            @endforeach
        </select><br>

        <label for="emp">Access Tool</label>
        <select name="access_tool_id">
            @foreach ($tools as $tool)
                <option value="{{ $tool->id }}">{{ $tool->tool }}</option>
            @endforeach
        </select><br>
        
        <label for="had_access">Had Access</label>
            <input type="checkbox" name="had_access[]" data-toggle="toggle" data-on="True" data-off="False" data-onstyle="success" data-offstyle="danger">
            <br>
            
            <label for="access_removed">Access Removed</label>
            <input type="checkbox" name="access_removed[]" data-toggle="toggle" data-on="True" data-off="False" data-onstyle="success" data-offstyle="danger">
            <br>

            <label for="remarks">Remarks</label>
            <input type="text" name="remarks[]" placeholder="Remarks"><br><br>

        
        <input type="submit" value="Submit">
    </form>
</body>
</html>