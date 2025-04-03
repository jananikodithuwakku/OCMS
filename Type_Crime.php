<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crime Statistics by District</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 30px;
            background-color: #0A192F;
            color: #E0E0E0;
        }
        /* Header */
        header {
            background-color: #051f3a;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            color: white;
        }

        .logo img {
            width: 50px;
            height: 50px;
        }

        h1 {
            font-size: 1.8rem;
            font-weight: bold;
            text-align: center;
            flex-grow: 1;
        }

        /* Navigation Bar */
        .navbar {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            gap: 20px;
        }

        .navbar li {
            display: inline;
        }

        .navbar a {
            text-decoration: none;
            color: white;
            padding: 10px 15px;
            transition: 0.3s;
            border-radius: 5px;
        }

        .navbar a:hover {
            background-color:rgb(73, 84, 95);
        }
        .table-container {
            display: flex;
            justify-content: center;
        }
        table {
            width: 90%;
            max-width: 1200px;
            border-collapse: collapse;
            background: #112240;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            padding: 12px;
            border: 1px solid #233554;
            text-align: center;
        }
        th {
            background-color:rgb(166, 192, 186);
            color: #0A192F;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #1B2C4E;
        }
        tr:hover {
            background-color: #2563eb;
            color: white;
            transition: 0.3s;
        }
    </style>
</head>
<body>
    
    <!-- Header -->
    <header>
        <div class="logo">
            <img src="Images/Logo.png" alt="OCMS Logo">
        </div>
        <h1>Crime Statistics by District</h1>
        <nav>
            <ul class="navbar">
                <li><a href="Home.php">Home</a></li>
                <li><a href="view-crime-map.php">Crime Map</a></li>
                <li><a href="Features.php">Features</a></li>
            </ul>
        </nav>
    </header>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>District</th>
                    <th>Total Crimes</th>
                    <th>Homicide</th>
                    <th>Assault</th>
                    <th>Theft</th>
                    <th>Drug Offenses</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>COLOMBO</td> <td>1200</td> <td>50</td> <td>300</td> <td>500</td> <td>350</td>
                </tr>
                <tr>
                    <td>GAMPAHA</td> <td>950</td> <td>30</td> <td>250</td> <td>400</td> <td>270</td>
                </tr>
                <tr>
                    <td>KALUTARA</td> <td>720</td> <td>25</td> <td>180</td> <td>320</td> <td>195</td>
                </tr>
                <tr>
                    <td>KEGALLE</td> <td>500</td> <td>15</td> <td>120</td> <td>200</td> <td>165</td>
                </tr>
                <tr>
                    <td>KURUNEGALA</td> <td>680</td> <td>20</td> <td>160</td> <td>280</td> <td>220</td>
                </tr>
                <tr>
                    <td>JAFFNA</td> <td>300</td> <td>10</td> <td>80</td> <td>120</td> <td>90</td>
                </tr>
                <tr>
                    <td>AMPARA</td> <td>250</td> <td>5</td> <td>60</td> <td>110</td> <td>75</td>
                </tr>
                <tr>
                    <td>BATTICALOA</td> <td>220</td> <td>8</td> <td>50</td> <td>100</td> <td>62</td>
                </tr>
                <tr>
                    <td>MULLAITIVU</td> <td>150</td> <td>3</td> <td>40</td> <td>70</td> <td>37</td>
                </tr>
                <tr>
                    <td>NUWARA ELIYA</td> <td>180</td> <td>4</td> <td>45</td> <td>85</td> <td>46</td>
                </tr>
                <tr>
                    <td>ANURADHAPURA</td> <td>410</td> <td>12</td> <td>100</td> <td>180</td> <td>120</td>
                </tr>
                <tr>
                    <td>BADULLA</td> <td>360</td> <td>10</td> <td>90</td> <td>150</td> <td>110</td>
                </tr>
                <tr>
                    <td>GALLE</td> <td>600</td> <td>18</td> <td>130</td> <td>250</td> <td>200</td>
                </tr>
                <tr>
                    <td>HAMBANTOTA</td> <td>320</td> <td>7</td> <td>85</td> <td>140</td> <td>100</td>
                </tr>
                <tr>
                    <td>KANDY</td> <td>580</td> <td>16</td> <td>140</td> <td>260</td> <td>190</td>
                </tr>
                <tr>
                    <td>MATALE</td> <td>270</td> <td>6</td> <td>75</td> <td>130</td> <td>85</td>
                </tr>
                <tr>
                    <td>MONERAGALA</td> <td>190</td> <td>5</td> <td>50</td> <td>100</td> <td>65</td>
                </tr>
                <tr>
                    <td>POLONNARUWA</td> <td>240</td> <td>6</td> <td>65</td> <td>120</td> <td>80</td>
                </tr>
                <tr>
                    <td>RATNAPURA</td> <td>410</td> <td>12</td> <td>110</td> <td>190</td> <td>125</td>
                </tr>
                <tr>
                    <td>TRINCOMALEE</td> <td>280</td> <td>8</td> <td>70</td> <td>130</td> <td>90</td>
                </tr>
                <tr>
                    <td>VAVUNIYA</td> <td>200</td> <td>4</td> <td>55</td> <td>90</td> <td>60</td>
                </tr>
                <tr>
                    <td>MANNAR</td> <td>180</td> <td>3</td> <td>40</td> <td>80</td> <td>50</td>
                </tr>
                <tr>
                    <td>PUTTALAM</td> <td>450</td> <td>14</td> <td>120</td> <td>200</td> <td>140</td>
                </tr>
                <tr>
                    <td>MATARA</td> <td>600</td> <td>18</td> <td>140</td> <td>250</td> <td>190</td>
                </tr>
                <tr>
                    <td>KILINOCHCHI</td> <td>200</td> <td>6</td> <td>50</td> <td>90</td> <td>55</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
