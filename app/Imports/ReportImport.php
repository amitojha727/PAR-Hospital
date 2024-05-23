<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\ReportExcel;

class ReportImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $row) {
            if ($key > 0) {
                $report = new ReportExcel;
                $report->ex_a =\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[0]);
                $report->ex_b =$row[1];
                $report->ex_c =$row[2];
                $report->ex_d =$row[3];
                $report->ex_e =\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[4]);
                $report->ex_f =$row[5];
                $report->ex_g =$row[6];
                $report->ex_h =$row[7];
                $report->ex_i =$row[8];
                $report->ex_j =$row[9];
                $report->ex_k =$row[10];
                $report->ex_l =$row[11];
                $report->ex_m =$row[12];
                $report->ex_n =$row[13];
                $report->ex_o =$row[14];
                $report->ex_p =$row[15];
                $report->ex_q =$row[16];
                $report->ex_r =$row[17];
                $report->ex_s =$row[18];
                $report->ex_t =$row[19];
                $report->ex_u =$row[20];
                $report->ex_v =$row[21];
                $report->ex_w =$row[22];
                $report->ex_x =$row[23];
                $report->ex_y =$row[24];
                $report->ex_z =$row[25];
                $report->ex_aa =$row[26];
                $report->ex_ab =$row[27];
                $report->ex_ac =$row[28];
                $report->ex_ad =$row[29];
                $report->ex_ae =$row[30];
                $report->ex_af =$row[31];
                $report->ex_ag =$row[32];
                $report->ex_ah =$row[33];
                $report->ex_ai =$row[34];
                $report->ex_aj =$row[35];
                $report->ex_ak =$row[36];
                $report->ex_al =$row[37];
                $report->ex_am =$row[38];
                $report->ex_an =$row[39];
                $report->ex_ao =$row[40];
                $report->ex_ap =$row[41];
                $report->ex_aq =$row[42];
                $report->ex_ar =$row[43];
                $report->ex_as =$row[44];
                $report->ex_at =$row[45];
                $report->ex_au =$row[46];
                $report->ex_av =$row[47];
                $report->ex_aw =$row[48];
                $report->ex_ax =$row[49];
                $report->ex_ay =$row[50];
                $report->ex_az =$row[51];
                $report->ex_ba =$row[52];
                $report->ex_bb =$row[53];
                $report->ex_bc =$row[54];
                $report->ex_bd =$row[55];
                $report->ex_be =$row[56];
                $report->ex_bf =$row[57];
                $report->ex_bg =$row[58];
                $report->ex_bh =$row[59];
                $report->ex_bi =$row[60];
                $report->ex_bj =$row[61];
                $report->ex_bk =$row[62];
                $report->ex_bl =$row[63];
                $report->ex_bm =$row[64];
                $report->ex_bn =$row[65];
                $report->ex_bo =$row[66];
                $report->ex_bp =$row[67];
                $report->ex_bq =$row[68];
                $report->save();
            }
        }
        return true;
    }
    // public function model(array $rows)
    // {
    //     // return new ReportExcel([
    //     //    'ex_a' => $row[0],
    //     //    'ex_b' => $row[1], 
    //     //    'ex_c' => $row[2]
    //     // ]);
    //     foreach ($rows as $key => $row) {
    //         new ReportExcel([
    //             'ex_a' => $row[0],
    //             'ex_b' => $row[1], 
    //             'ex_c' => $row[2]
    //          ]);
    //     }
    //     return true;
    // }
}
