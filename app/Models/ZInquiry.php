<?php

namespace App\Models;

use App\Helpers\Helper;
use App\Models\Traits\ModelBasically;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ZInquiry
 * @package App\Models
 *
 * @property string $name
 * @property integer $title
 * @property integer $number_of_room
 * @property int $quantity_adults
 * @property int $quantity_children
 * @property int $quantity_infants
 * @property string $email
 * @property string $phone
 * @property string $start_date
 */
class ZInquiry extends Model
{
    use ModelBasically;

    protected $fillable = [
        "z_package_id", "start_date",
        "quantity_adults", "quantity_children",
        "quantity_infants", "transfer",
        "title", "name", "country",
        "email", "phone", "z_room_id",
        "special_request", "promotion_text",
        "promotion_price", "number_of_room"
    ];

    const TITLE_MR = 1;
    const TITLE_MRS = 2;
    const TITLES = [self::TITLE_MR, self::TITLE_MRS];

    const FORMAT_START_DATE = "D, F d, Y";

    public function zPackage()
    {
        return $this->belongsTo(ZPackage::class);
    }

    public function zRoom()
    {
        return $this->belongsTo(ZRoom::class);
    }

    public function zTransfer()
    {
        return $this->belongsTo(ZTransfer::class, "transfer");
    }

    public function zTransferActive()
    {
        return $this->zTransfer()->active();
    }

    public function getCustomerName($withTitle = true)
    {
        $name = "";

        if ($withTitle) {
            $name .= __("admin_table.z_inquiries.option_title_" . $this->title);
        }

        $name .= " " . $this->name;

        return $name;
    }

    public function getNumberOfRoomText()
    {
        return Helper::addZeroToNumber($this->number_of_room);
    }

    public function getNumberOfGuestText()
    {
        $adultsLabel = __("site_global.label_adult" . ($this->quantity_adults > 1 ? "s" : "") . "_2");
        $childrenLabel = __("site_global.label_child" . ($this->quantity_adults > 1 ? "ren" : "") . "_2");
        $infantsLabel = __("site_global.label_infant" . ($this->quantity_adults > 1 ? "s" : "") . "_2");

        $string[] = "{$this->quantity_adults} {$adultsLabel}";
        $string[] = "{$this->quantity_children} {$childrenLabel}";
        $string[] = "{$this->quantity_infants} {$infantsLabel}";

        return implode(", ", $string);
    }

    public function getContactInformation()
    {
        return $this->email . " - " . $this->phone;
    }

    public function getStartDateDisplay()
    {
        $date = date_create_from_format("Y-m-d", $this->start_date);

        if (!$date) {
            return "";
        }

        return $date->format(self::FORMAT_START_DATE);
    }
}
