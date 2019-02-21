<?php

if ( ! function_exists('format_rupiah'))
{
    /**
     * Convert to Format Rupiah
     *
     * @param    integer    required
     * @return    string
     */
    function format_rupiah($data)
    {
        return 'Rp. ' . number_format($data, 0, '', '.');
    }
}

if ( ! function_exists('badge_boolean'))
{
    /**
     * Badge Boolean
     *
     * @param    boolean    required
     * @return    string
     */
    function badge_boolean($bool)
    {
        $text = ($bool == 1 ? 'Aktif' : 'Nonaktif');
        $badge = ($bool == 1 ? 'success' : 'danger');

        return '<span class="badge badge-'.$badge.'">'.$text.'</span>';
    }
}
