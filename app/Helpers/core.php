<?php
/**
 * Get Phone's International Format
 *
 * @param string|null $phone
 * @param $countryCode
 * @param int $format
 * @return array|string|string[]|null
 */
function phoneFormatInt(?string $phone, $countryCode = null, int $format = \libphonenumber\PhoneNumberFormat::INTERNATIONAL)
{
    return phoneFormat($phone, $countryCode, $format);
}


/**
 * Get Phone's National Format
 *
 * @param string|null $phone
 * @param string|null $countryCode
 * @param int $format
 * @return array|string|string[]|null
 */
function phoneFormat(?string $phone, string $countryCode = null, int $format = \libphonenumber\PhoneNumberFormat::NATIONAL)
{
    // Set the phone format
    try {
        $phone = phone($phone, $countryCode, $format);
    } catch (\Throwable $e) {
        // Keep the default value
    }

    // Keep only numeric characters
    return preg_replace('/[^0-9\+]/', '', $phone);
}

