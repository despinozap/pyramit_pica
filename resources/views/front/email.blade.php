<!DOCTYPE html>
<html lang="en">
    <head>

        <style type="text/css">

            table{
                width: 100%;
                font-size: 14px;
            }

            td{
                border-color: #DDDDDD;
            }

            .header{
                margin-left:auto;
                margin-right:auto;

                background: #FFC400;
                padding: 30px 30px 20px 30px;
                font: 20px Arial, Helvetica, sans-serif;
                color: #FFF;
                border-radius: 5px 5px 0px 0px;
                -webkit-border-radius: 5px 5px 0px 0px;
                -moz-border-radius: 5px 5px 0px 0px;
            }

            .title{
                font-weight: bold;
                border-top: 1px solid;
                border-left: 1px solid;
            }

            .value{
                border-top: 1px solid;
                border-left: 1px solid;
                border-right: 1px solid;
            }

            .td-top{
                border-top: 0px;
            }

            .td-bottom
            {
                border-bottom: 1px solid;
            }

        </style>

    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th colspan="2" class="header">¡Nuevo mensaje!</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td width="20%" class="title">Nombre</td>
                    <td width="80%" class="value">{{ $name }}</td>
                </tr>
                <tr>
                    <td width="20%" class="title">Email</td>
                    <td width="80%" class="value">{{ $email }}</td>
                </tr>
                <tr>
                    <td width="20%" class="title">Teléfono</td>
                    <td width="80%" class="value">{{ $phone }}</td>
                </tr>
                <tr>
                    <td width="20%" class="title">Fecha</td>
                    <td width="80%" class="value">{{ $date }}</td>
                </tr>
                <tr>
                    <td width="20%" class="title td-bottom">Mensaje</td>
                    <td width="80%" class="value td-bottom">{{ $comment }}</td>
                </tr>
            </tbody>
        </table>
    </body>
</html>
