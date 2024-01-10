<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PaySlip</title>
</head>

<body style="margin: 30px;">
    <header style=" line-height: 3px; display: flex;">
        <div style="width: 33%;">
            <img src="./Capture.PNG">
        </div>
        <div style="text-align: center; width: 33%;">
            <h1><b>Absax technologies PVT.LTD</b></h1>
            <h4>Ground floor, Wing-B, Building B1, Golden Tower</h4>
            <h4>Infratech, NSL, TechZone IT SEZ, Plot no. 8,</h4>
            <h4>Sector 144, Noida - 201 301</h4>
        </div>
        <div style="width: 33%;"></div>

    </header>
    <h1 style="text-align: center;">Payslip for the month of October - 2023</h1>
    <div id="employee-details" style="display:flex">
        <div style="border-style: solid; width: 50%;">
            <table id="t1" style="width: 100%; ">
                <tbody>
                    @if($payslips->isNotEmpty())
                    @foreach($payslips as $slip)
                    <tr>
                        <td>Name:</td>
                        <td>{{$slip->name}}</td>
                    </tr>
                    <tr>
                        <td>Joining Date:</td>
                        <td>{{$slip->joining_date}}</td>
                    </tr>
                    <tr>
                        <td>Designation:</td>
                        <td>{{$slip->designation}}</td>
                    </tr>
                    <tr>
                        <td>Department:</td>
                        <td>{{$slip->department}}</td>
                    </tr>
                    <tr>
                        <td>Location:</td>
                        <td>{{$slip->location}}</td>
                    </tr>
                    <tr>
                        <td>Effective Work Days:</td>
                        <td>Umesh</td>
                    </tr>
                    <tr>
                        <td>LOP:</td>
                        <td>Umesh</td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div style="border-style: solid; width: 50%;">
            <table id="t2" style="width: 100%;">
                <tbody>
                    <tr>
                        <td>Name:</td>
                        <td>Umesh</td>
                    </tr>
                    <tr>
                        <td>Name:</td>
                        <td>Umesh</td>
                    </tr>
                    <tr>
                        <td>Name:</td>
                        <td>Umesh</td>
                    </tr>
                    <tr>
                        <td>Name:</td>
                        <td>Umesh</td>
                    </tr>
                    <tr>
                        <td>Name:</td>
                        <td>Umesh</td>
                    </tr>
                    <tr>
                        <td>Name:</td>
                        <td>Umesh</td>
                    </tr>
                    <tr>
                        <td>Name:</td>
                        <td>Umesh</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div id="pay-details" style="display:flex; padding-top: 20px; line-height: 30px;">
        <div style="border-style: solid; width: 50%;">
            <table id="t3" style="width: 100%; height: 100%;">
                <thead>
                    <th style="border-bottom: 2px solid black; text-align: left;">
                        <b>Earnings</b>
                    </th>
                    <th style="border-bottom: 2px solid black; text-align: right;">
                        Amount
                    </th>
                </thead>
                <tbody>
                    <tr>
                        <td>Name:</td>
                        <td style="text-align: right;">Umesh</td>
                    </tr>
                    <tr>
                        <td>Name:</td>
                        <td style="text-align: right;">Umesh</td>
                    </tr>
                    <tr>
                        <td>Name:</td>
                        <td style="text-align: right;">Umesh</td>
                    </tr>
                    <tr>
                        <td>Name:</td>
                        <td style="text-align: right;">Umesh</td>
                    </tr>
                    <tr>
                        <td>Name:</td>
                        <td style="text-align: right;">Umesh</td>
                    </tr>
                    <tr>
                        <td>Name:</td>
                        <td style="text-align: right;">Umesh</td>
                    </tr>
                    <tr>
                        <td>Name:</td>
                        <td style="text-align: right;">Umesh</td>
                    </tr>
                    <tr>
                        <td>Name:</td>
                        <td style="text-align: right;">Umesh</td>
                    </tr>

                </tbody>
                <tfoot>
                    <tr>
                        <td style="border-top: 2px solid;"><b>Total Earnings</b></td>
                        <td style="text-align: right; border-top: 2px solid;"><b>1234</b></td>
                    </tr>
                </tfoot>
            </table>
            <table style="width: 100%;"></table>
        </div>
        <div style="border-style: solid; width: 50%;">
            <table id="t4" style="width: 100%; height: 100%;">
                <thead>
                    <th style="border-bottom: 1px solid black; text-align: left;">
                        <b>Earnings</b>
                    </th>
                    <th style="border-bottom: 1px solid black; text-align: right;">
                        Amount
                    </th>
                </thead>
                <tbody>
                    <tr>
                        <td>PF</td>
                        <td style="text-align: right;">1,800.00</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td style="border-top: 2px solid;"><b>Total Deduction</b></td>
                        <td style="text-align: right; border-top: 2px solid;"><b>1234</b></td>
                    </tr>
                </tfoot>
            </table>

        </div>

    </div>
    </div>
    <div id="net-pay-details" style="display:flex; border-style: solid ;">
        <h4>
            Net Pay for the month :<br>
            _____________________________________(only)
        </h4>
    </div>
    <div style="background-color: rgb(189, 180, 180); padding: 0px; margin: 0px ;line-height: 30px;">
        <h3 style="text-align: center;  padding: 0px; margin: 0px ;">TDS Details</h3>
    </div>
    <div id="TDS-details" style="display:flex ; line-height: 30px;">
        <div style=" width: 60%; margin-right: 10px;">
            <div style="border-style: solid;">
                <table border="1" id="t1" style="width: 100%;  border-collapse: collapse;">
                    <thead>
                        <td>Name:</td>
                        <td style="text-align: right;">Umesh</td>
                        <td style="text-align: right;">1234</td>
                        <td style="text-align: right;">12345</td>
                    </thead>
                    <tbody>

                        <tr>
                            <td>Name:</td>
                            <td style="text-align: right;">Umesh</td>
                            <td style="text-align: right;">1234</td>
                            <td style="text-align: right;">12345</td>
                        </tr>
                        <tr>
                            <td>Name:</td>
                            <td style="text-align: right;">Umesh</td>
                            <td style="text-align: right;">1234</td>
                            <td style="text-align: right;">12345</td>
                        </tr>
                        <tr>
                            <td>Name:</td>
                            <td style="text-align: right;">Umesh</td>
                            <td style="text-align: right;">1234</td>
                            <td style="text-align: right;">12345</td>
                        </tr>
                        <tr>
                            <td>Name:</td>
                            <td style="text-align: right;">Umesh</td>
                            <td style="text-align: right;">1234</td>
                            <td style="text-align: right;">12345</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="border-style: solid; margin-top: 10px;">
                <table border="1" id="t1" style="width: 100%;  border-collapse: collapse;">
                    <thead>

                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="4" style="text-align: center;"><b>Deduction Under Chapter VI-A</b></td>
                        </tr>
                        <tr>
                            <td colspan="1" style="width: 75%;">Name:</td>
                            <td colspan="1" style="text-align: right;">Umesh</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
        <div style=" width: 40%;">
            <div style="border-style: solid;">
                <table id="t6" border="1" style="width: 100%; border-collapse: collapse;">
                    <tbody>
                        <tr>
                            <td colspan="2" style=" text-align: center;"><b>Income Tax Deduction</b></td>
                        </tr>
                        <tr>
                            <td style="width: 70%;">Name:</td>
                            <td style="text-align: right;">Umesh</td>
                        </tr>
                        <tr>
                            <td>Name:</td>
                            <td style="text-align: right;">Umesh</td>
                        </tr>
                        <tr>
                            <td>Name:</td>
                            <td style="text-align: right;">Umesh</td>
                        </tr>
                        <tr>
                            <td>Name:</td>
                            <td style="text-align: right;">Umesh</td>
                        </tr>
                        <tr>
                            <td>Name:</td>
                            <td style="text-align: right;">Umesh</td>
                        </tr>
                        <tr>
                            <td>Name:</td>
                            <td style="text-align: right;">Umesh</td>
                        </tr>
                        <tr>
                            <td>Name:</td>
                            <td style="text-align: right;">Umesh</td>
                        </tr>
                        <tr>
                            <td>Name:</td>
                            <td style="text-align: right;">Umesh</td>
                        </tr>
                        <tr>
                            <td>Name:</td>
                            <td style="text-align: right;">Umesh</td>
                        </tr>
                        <tr>
                            <td>Name:</td>
                            <td style="text-align: right;">Umesh</td>
                        </tr>
                        <tr>
                            <td>Name:</td>
                            <td style="text-align: right;">Umesh</td>
                        </tr>
                        <tr>
                            <td>Name:</td>
                            <td style="text-align: right;">Umesh</td>
                        </tr>
                        <tr>
                            <td>Name:</td>
                            <td style="text-align: right;">Umesh</td>
                        </tr>
                        <tr>
                            <td>Name:</td>
                            <td style="text-align: right;">Umesh</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="border-style: solid; margin-top: 10px;">
                <table border="1" id="t7" style="width: 100%;  border-collapse: collapse;">
                    <thead>

                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6" style="text-align: center;"><b>Tax Paid Details</b></td>
                        </tr>
                        <tr style="height: 40px;">
                            <td><b>APR</b></td>
                            <td><b>MAY</b></td>
                            <td><b>JUN</b></td>
                            <td><b>JUL</b></td>
                            <td><b>AUG</b></td>
                            <td><b>SEP</b></td>
                        </tr>
                        <tr style="height: 40px;">
                            <td><b></b></td>
                            <td><b></b></td>
                            <td><b></b></td>
                            <td><b></b></td>
                            <td><b></b></td>
                            <td><b></b></td>
                        </tr>
                        <tr style="height: 40px;">
                            <td><b>OCT</b></td>
                            <td><b>NOV</b></td>
                            <td><b>DEC</b></td>
                            <td><b>JAN</b></td>
                            <td><b>FEB</b></td>
                            <td><b>MAR</b></td>
                        </tr>
                        <tr style="height: 40px;">
                            <td><b>iouis</b></td>
                            <td><b></b></td>
                            <td><b></b></td>
                            <td><b></b></td>
                            <td><b></b></td>
                            <td><b></b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>

</html>