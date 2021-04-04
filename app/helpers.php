<?php

/**
 * Gives human readable formatted datetime for date
 *
 * @param \Carbon\Carbon $dateTime
 * @return string
 */
function formattedDateTime(Carbon\Carbon $dateTime)
{
    return $dateTime->setTimezone(timezone())->format('d F Y, h:ia');
}

/**
 * Gives human readable formatted date
 *
 * @param \Carbon\Carbon $dateTime
 * @return string
 */
function formattedDate(Carbon\Carbon $dateTime)
{
    return $dateTime->setTimezone(timezone())->format('d F Y');
}


/**
 * Gives timezone of the system
 *
 * @param null $user
 * @return mixed|string
 */
function timezone($user = null): string
{
    $user = $user ?: Auth::user();

    if($user && $user->timezone_id) {
        return $user->timezone->name;
    }

    return config('app.timezone');
}

/**
 * Gets formatted amount
 *
 * @param $amount
 * @param string $currency
 * @return string
 */
function formattedAmount($amount, $currency = '$')
{
    return $currency. number_format($amount);
}
