<?php

class UserSubscription
{
    use Model; // Use the Model trait

    protected $table = 'UserSubscription'; //when using the Model trait, this table name ise used 


    public function getMonthlySubscriptionSummary($startDate, $endDate)
    {
        $startDateEscaped = "'" . $startDate . "'";
        $endDateEscaped = "'" . $endDate . "'";

        $query = "SELECT
                    s.planName,
                    SUM(
                        (DATEDIFF(MONTH, 
                            CASE 
                                WHEN CAST(us.[subStartDate] AS DATE) < {$startDateEscaped} THEN {$startDateEscaped} 
                                ELSE CAST(us.[subStartDate] AS DATE) 
                            END,
                            CASE 
                                WHEN us.[subEndDate] IS NULL OR us.[subEndDate] >= {$endDateEscaped} THEN {$endDateEscaped} 
                                ELSE CAST(us.[subEndDate] AS DATE) 
                            END
                        ) + 1) * s.price
                    ) AS totalPaid
                    FROM [dbo].[UserSubscription] us
                    INNER JOIN [dbo].[Subscription] s ON us.[subscription] = s.[subID]
                    WHERE
                    us.[subStartDate] <= {$endDateEscaped} + ' 23:59:59'  
                    AND (us.[subEndDate] IS NULL OR us.[subEndDate] >= {$startDateEscaped})
                    GROUP BY s.planName";

        return $this->query($query);
    }
}
