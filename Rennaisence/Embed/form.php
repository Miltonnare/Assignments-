<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <style>
    body {
      background: linear-gradient(135deg, #4facfe, #00f2fe);
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    form {
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
      display: flex;
      gap: 15px;
      align-items: center;
    }

    input, select, button {
      padding: 10px 15px;
      font-size: 1rem;
      border: 1px solid #ccc;
      border-radius: 6px;
      outline: none;
      transition: all 0.3s ease;
    }

    input:focus, select:focus {
      border-color: #4facfe;
      box-shadow: 0 0 5px rgba(79, 172, 254, 0.6);
    }

    button {
      background: #4facfe;
      color: white;
      border: none;
      cursor: pointer;
      font-weight: bold;
      transition: background 0.3s ease;
    }

    button:hover {
      background: #007bff;
    }
    </style>
</head>
<body>
    
<form action="functions.php" method="get">
    <input type="text" name="num01" placeholder="Number 1">
    <select name="oper" id="operations">
        <label for="operations">Choose operation</label>
        <option value="add">Add</option>
        <option value="sub">Sub</option>
    </select>
    <input type="text" name="num02" placeholder="Number 2">
    <button type="submit">Calculate</button>
</form>
</body>
</html>