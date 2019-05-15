<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Feedback - TJ's Fundraising </title>
</head>
<body style="margin: 0; padding: 0;">
    <table>
        <tbody>
            <tr>
                <td>
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    Hi <?php echo isset($customer_info) ? $customer_info->first_name :''?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                Your package has been delivered!
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                Please rate your delivery experience.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <form action="">
                                        <a href="<?php echo BASE_URL.'comment/'.base64_encode($order_id)?>">
                                            <img src="<?php echo ASSETS?>global/img/5-stars.png" alt="5 starts" height="100px">
                                        </a>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                   Thanks,
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                   <b>TJ's Fundraising</b>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>
<script src="<?php echo ASSETS ?>global/plugins/jquery.min.js"></script><!--jquery js-->
<script src="<?php echo ASSETS ?>global/plugins/bootstrap/js/bootstrap.min.js"></script><!--bootstrap js-->
</html>