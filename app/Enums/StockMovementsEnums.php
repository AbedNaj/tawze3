<?php

namespace App\Enums;

enum StockMovementsEnums: string
{
    /** Stock added due to purchasing from a supplier */
    case PurchaseIn = 'purchase_in';

    /** Stock deducted due to an actual sale to a customer */
    case SaleOut = 'sale_out';

    /** Stock added due to a customer return */
    case ReturnIn = 'return_in';

    /** Stock added manually to correct an inventory discrepancy */
    case AdjustmentIn = 'adjustment_in';

    /** Stock deducted manually to correct an inventory discrepancy */
    case AdjustmentOut = 'adjustment_out';

    /** Stock deducted when transferring items out to another employee/warehouse */
    case TransferOut = 'transfer_out';

    /** Stock added when receiving items transferred from another employee/warehouse */
    case TransferIn = 'transfer_in';

    /** Stock reserved for a pending order (not deducted yet) */
    case Reserved = 'reserved';

    /** Reserved stock released back to available inventory */
    case ReservedRelease = 'reserved_release';

    /** General correction entry for special or unclassified adjustments */
    case Correction = 'correction';
}
