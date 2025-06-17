<?php
    if ($recent_logs['status'] == 'Pending' || $recent_logs['status'] == 'Approved') {
        ?>
            <a onclick="rejects('../Rejects/rejectBook.php?book=<?= $recent_logs['book_id']?>&c=<?= $category?>&s=Rejected')">
        
                <button style="background-color: maroon; color: white; border: none; padding: 5px; width: 80px;display: flex;
                                justify-content: space-around; align-items: center;cursor: pointer;">
                        
                        <i class="fa-solid fa-circle-xmark" style="color: white;"></i>
                            Reject
                </button>
            </a>
        <?php
    }

    if ($recent_logs['status'] == 'Approved' || $recent_logs['status'] == 'Rejected') {
        ?>
            <a onclick="archive('../fnc/pending.php?book=<?= $recent_logs['book_id']?>&c=<?= $category?>&s=Archive')">
                <button style="background-color: red; color: white; border: none; padding: 5px; width: 80px;display: flex;
                                justify-content: space-around; align-items: center;cursor: pointer;">
                        <i class="fa-solid fa-circle-xmark" style="color: white;"></i>
                            Archive
                        </button>
            </a>
        <?php
    }

    if ($recent_logs['status'] == 'Pending' || $recent_logs['status'] == 'Rejected') {
        ?>
            <button style="background-color: rgb(117, 59, 22); color: white; border: none; padding: 5px; width: 80px;display: flex;
                            justify-content: space-around; align-items: center;cursor: pointer;"
                    data-id="<?= $recent_logs['book_id']; ?>" data-name="Clarence" onclick="handleClick(
                    this.getAttribute('data-id'))">
                        <i class="fa-solid fa-square-check" style="color: white;"></i>
                                Approved
            </button>
        <?php
    }

    if ($recent_logs['status'] == 'Archive') { 

    }

?>