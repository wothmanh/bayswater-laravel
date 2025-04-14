<?php
    if(!isset($_GET['data'])){
        exit();
    }

    // Decode the incoming data
    $data = json_decode($_GET['data'], true);

    //var_dump($data); 

    //var_dump($data['centre']); 
    //var_dump($data['totals']); 
    //var_dump($data['course']); 
    //var_dump($data['accommodation']); 
    //var_dump($data['promo']); 
    //var_dump($data['insurance']); 
    //var_dump($data['airport']); 
    //var_dump($data['others']); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Price Quote</title>
    <link rel="stylesheet" href="<?php echo $this->config->item('base_url2');?>css/quote_style.css" />
</head>
<body >	

    <!-- Printable part -->
    <div class="container" id="quote">
	
		<div>
			<img id="wbstlogoimg" src="<?php echo $this->config->item('base_url2'),'img/',$settings->logo; ?>">
			<span><?php echo date('Y-m-d') ?></span>
		</div>
        
        <h1>Price Quote</h1>

        <?php if(!empty($data['centre']['name'])){ ?>
            <section class="info">
                <div>
                    <h4>Center</h4>
                    <p>
                        <strong>
                            <?php echo !empty($data['centre']['name']) ? $data['centre']['name'] : 'N/A'; ?>
                        </strong>
                        <strong>
                            (
                                <?php echo !empty($data['city']['name']) ? $data['city']['name'] : 'N/A'; ?>
                            , 
                                <?php echo !empty($data['country']['name']) ? $data['country']['name'] : 'N/A'; ?>
                            )
                        </strong>
                    </p>
                </div>
            </section>
        <?php } ?>

        <!-- Table for Product 1 (Course) -->
        <table>
            <thead>
                <tr>
                    <th>Course</th>
                    <th class="sub-total">
                        <?php echo isset($data['totals']['subSum1']) && !empty($data['totals']['subSum1']) ? number_format($data['totals']['subSum1'], 2) : '0.00'; ?> EUR
                    </th>
                </tr>
            </thead>
            <tbody>

                <?php if(isset($data['course']['name']) && !empty($data['course']['name'])){ ?>
                <tr>
                    <td>
                        <?php echo isset($data['course']['name']) ? $data['course']['name'] : 'N/A'; ?><br/>
                        From <?php echo isset($data['course']['start_date']) ? $data['course']['start_date'] : 'N/A'; ?> To <?php echo isset($data['course']['end_date']) ? $data['course']['end_date'] : 'N/A'; ?> 
                        (<?php echo isset($data['course']['number_weeks']) ? $data['course']['number_weeks'] : 'N/A'; ?> weeks)
                    </td>
                    <td class="sub-total">
                        <?php echo isset($data['course']['prices']) && !empty($data['course']['prices']) ? number_format($data['course']['prices'], 2) : '0.00'; ?> EUR
                    </td>
                </tr>
                <?php } ?>

                <?php if(!empty($data['course']['discount_amount'])){ ?>
                <tr>
                    <td><?php echo $data['course']['discount_percent'] ?>% off tuition prices</td>
                    <td class="sub-total">
                        <?php echo isset($data['course']['discount_amount']) && !empty($data['course']['discount_amount']) ? "-" . number_format($data['course']['discount_amount'], 2) : '0.00'; ?> EUR
                    </td>
                </tr>
                <?php } ?>

                <?php if(!empty($data['centre']['enrolment_fee'])){ ?>
                <tr>
                    <td>Enrolment fee (non-refundable)</td>
                    <td class="sub-total">
                        <?php echo isset($data['centre']['enrolment_fee']) && !empty($data['centre']['enrolment_fee']) ? number_format($data['centre']['enrolment_fee'], 2) : '0.00'; ?> EUR
                    </td>
                </tr>
                <?php } ?>

                <?php if(!empty($data['centre']['bank_change'])){ ?>
                <tr>
                    <td>Bank charges</td>
                    <td class="sub-total">
                        <?php echo isset($data['centre']['bank_change']) && !empty($data['centre']['bank_change']) ? number_format($data['centre']['bank_change'], 2) : '0.00'; ?> EUR
                    </td>
                </tr>
                <?php } ?>
                
                <!-- Addons (if any) -->
                <?php if (isset($data['addon']['prices']) && !empty($data['addon']) && $data['addon']['prices'] != ""): ?>
                    <tr>
                        <td>
                            Addons: <?php echo isset($data['addon']['name']) ? $data['addon']['name'] : 'N/A'; ?><br/>
                            <?php echo isset($data['addon']['number_weeks']) ? $data['addon']['number_weeks'] : 'N/A'; ?>
                            Start From : <?php echo isset($data['addon']['start_date']) ? $data['addon']['start_date'] : 'N/A'; ?>
                        </td>
                        <td class="sub-total"><?php echo isset($data['addon']['prices']) ? number_format($data['addon']['prices'], 2) : '0.00'; ?> EUR</td>
                    </tr>
                <?php endif; ?>

                <!-- Family Course -->
                <?php if (isset($data['family']) && !empty($data['family']) && $data['family']['prices'] != ""): ?>
                    <tr>
                        <td>
                            Family: <?php echo isset($data['family']['name']) ? $data['family']['name'] : 'N/A'; ?><br/>
                            <?php echo isset($data['family']['number_weeks']) ? $data['family']['number_weeks'] : 'N/A'; ?>, 
                            from <?php echo isset($data['family']['start_date']) ? $data['family']['start_date'] : 'N/A'; ?> to <?php echo isset($data['family']['end_date']) ? $data['family']['end_date'] : 'N/A'; ?>
                        </td>
                        <td class="sub-total"><?php echo isset($data['family']['prices']) ? number_format((double)$data['family']['prices'], 2) : '0.00'; ?> EUR</td>
                    </tr>
                <?php endif; ?>

                <!-- Exam Preparation -->
                <?php if (isset($data['exam']) && !empty($data['exam']) && $data['exam']['price'] != ""): ?>
                    <tr>
                        <td>
                            Exam Preparation: <?php echo isset($data['exam']['name']) ? $data['exam']['name'] : 'N/A'; ?><br/>
                            <?php echo isset($data['exam']['lessons']) ? $data['exam']['lessons'] : 'N/A'; ?> lessons, 
                            <?php echo isset($data['exam']['number_weeks']) ? $data['exam']['number_weeks'] : 'N/A'; ?> weeks, 
                            from <?php echo isset($data['exam']['start_date']) ? $data['exam']['start_date'] : 'N/A'; ?>
                        </td>
                        <td class="sub-total"><?php echo isset($data['exam']['price']) ? number_format((double)$data['exam']['price'], 2) : '0.00'; ?> EUR</td>
                    </tr>
                <?php endif; ?>

                <!-- Professional Course -->
                <?php if (isset($data['professional']) && !empty($data['professional']) && $data['professional']['price'] != ""): ?>
                    <tr>
                        <td>
                            Professional: <?php echo isset($data['professional']['name']) ? $data['professional']['name'] : 'N/A'; ?><br/>
                            <?php echo isset($data['professional']['number_weeks']) ? $data['professional']['number_weeks'] : 'N/A'; ?> weeks, 
                            from <?php echo isset($data['professional']['start_date']) ? $data['professional']['start_date'] : 'N/A'; ?>
                        </td>
                        <td class="sub-total"><?php echo isset($data['professional']['price']) ? number_format((double)$data['professional']['price'], 2) : '0.00'; ?> EUR</td>
                    </tr>
                <?php endif; ?>

            </tbody>
        </table>

        <!-- Table for Accommodation -->
        <table>
            <thead>
                <tr>
                    <th>Accommodation</th>
                    <th class="sub-total">
                        <?php echo isset($data['totals']['subSum2']) && !empty($data['totals']['subSum2']) ? number_format($data['totals']['subSum2'], 2) : '0.00'; ?> EUR
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($data['accommodation']['weeks']) && !empty($data['accommodation']['weeks'])){ ?>
                <tr>
                    <td>
                        Accommodation for <?php echo isset($data['accommodation']['weeks']) ? $data['accommodation']['weeks'] : 'N/A'; ?> weeks<br />
                        from <?php echo isset($data['accommodation']['start_date']) ? $data['accommodation']['start_date'] : 'N/A'; ?> to <?php echo isset($data['accommodation']['end_date']) ? $data['accommodation']['end_date'] : 'N/A'; ?>
                    </td>
                    <td class="sub-total"><?php echo isset($data['accommodation']['prices']) && !empty($data['accommodation']['prices']) ? number_format($data['accommodation']['prices'], 2) : '0.00'; ?> EUR</td>
                </tr>
                <?php } ?>
                
                <?php if(isset($data['accommodation']['price']) && !empty($data['accommodation']['price'])){ ?>
                <tr>
                    <td>20% off accommodation discount</td>
                    <td class="sub-total"><?php echo isset($data['accommodation']['price'])  && !empty($data['accommodation']['prices'])  ? '-' . number_format($data['accommodation']['discount'], 2) : '0.00'; ?> EUR</td>
                </tr>
                <?php } ?>

                <?php if (isset($data['promo']['prices']) && !empty($data['promo']['prices'])){ ?>
                    <tr>
                        <td>-<?php echo number_format($data['promo']['prices'], 2); ?> off accommodation offer</td>
                        <td class="sub-total">-<?php echo number_format($data['promo']['prices'], 2); ?> EUR</td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>

        <!-- Table for Extras -->
        <table>
            <thead>
                <tr>
                    <th>Extras</th>
                    <th class="sub-total">
                        <?php echo isset($data['totals']['subSum3']) && !empty($data['totals']['subSum3']) ? number_format($data['totals']['subSum3'], 2) : '0.00'; ?> EUR
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($data['course']['name']) && !empty($data['course']['name'])){ ?>
                <tr>
                    <td>my.Bayswater access and study resources</td>
                    <td class="sub-total">
                        <?php echo isset($data['totals']['booksFeePrice']) && !empty($data['totals']['booksFeePrice']) ? number_format($data['totals']['booksFeePrice'], 2) : '0.00'; ?> EUR
                    </td>
                </tr>
                <?php } ?>
                <?php if(isset($data['insurance']['weeks']) && !empty($data['insurance']['weeks'])){ ?>
                    <tr>
                        <td>Travel Insurance : <?php echo isset($data['insurance']['weeks']) ? $data['insurance']['weeks'] : '0'; ?> weeks</td>
                        <td class="sub-total">
                            <?php echo isset($data['insurance']['prices']) && !empty($data['insurance']['prices']) ? number_format($data['insurance']['prices'], 2) : '0.00'; ?> EUR
                        </td>
                    </tr>
                <?php } ?>

                <?php if(isset($data['airport']['arrival_name']) && !empty($data['airport']['arrival_name'])){ ?>
                <tr>
                    <td>Airport transfers - Arrival: <?php echo isset($data['airport']['arrival_name'])  && !empty($data['airport']['arrival_name']) ? $data['airport']['arrival_name'] : 'N/A'; ?></td>
                    <td class="sub-total"><?php echo isset($data['airport']['arrival_price']) && !empty($data['airport']['arrival_price']) ? number_format((double)$data['airport']['arrival_price'], 2) : '0.00'; ?> EUR</td>
                </tr>
                <?php } ?>

                <?php if(isset($data['airport']['departure_name']) && !empty($data['airport']['departure_name'])){ ?>
                <tr>
                    <td>Airport transfers - Departure: <?php echo isset($data['airport']['departure_name']) && !empty($data['airport']['prices']) ? $data['airport']['departure_price'] : 'N/A'; ?></td>
                    <td class="sub-total"><?php echo isset($data['airport']['departure_price']) ? number_format((double)$data['airport']['departure_price'], 2) : '0.00'; ?> EUR</td>
                </tr>
                <?php } ?>

            </tbody>
        </table>

        <p>Thank you for choosing us!</p>

        <!-- Total amount of the quote -->
        <div class="total" style="margin-top:0px;">
            <table>
                <thead>
                    <tr>
                        <th>Total (EUR)</th>
                        <th class="sub-total">
                            <?php
                                echo isset($data['totals']['subTotal']) && !empty($data['totals']['subTotal']) ? number_format($data['totals']['subTotal'], 2) : "0.00";
                            ?> EUR
                        </th>
                    </tr>
                </thead>
            </table>
        </div>
        
        <div>
            <?php echo html_entity_decode(html_entity_decode(html_entity_decode($settings->pdf_footer))); ?>
        </div>

    </div>

</body>
</html>

</body>
</html>
