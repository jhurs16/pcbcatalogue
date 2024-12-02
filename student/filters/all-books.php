<?php
require('../../connection/pdo.php');
include('../../sugarhelper.php');
$db = new DatabaseConnect();

$fpublisher = $_GET['fpublisher'];
//$fauthors = $_GET['fauthors'];
$fsourceoffund = $_GET['fsourceoffund'];
$fpub = $_GET['fpub'];
$fsection = $_GET['fsection'];

// books count
$db->query("SELECT b.*, r.*, pub.name AS pubname
FROM book b
INNER JOIN rack r ON r.rackid = b.Rack
INNER JOIN publisher pub ON pub.publisherid = b.publisher
WHERE pub.name LIKE '%{$fpublisher}%' 
AND b.Sourceoffund LIKE '%{$fsourceoffund}%'
AND b.Sourceoffund LIKE '%{$fsourceoffund}%'
AND b.PlaceOfPublication LIKE '%{$fpub}%'
AND b.Section LIKE '%{$fsection}%'");
$books = $db->set();


//dd($books);

// book authors
$db->query("SELECT a.*, ba.* FROM author a 
JOIN bookauthors ba ON ba.authorid = a.authorid;");
$authors_lists = $db->set();

// original authors
$db->query("SELECT * FROM author;");
$authors_origlists = $db->set();
//dd($authors_lists);
function printauthors($bookid, $authors)
{
    $results = [];
    foreach ($authors as $author) {
        if ($bookid == $author["bookid"]) {
            array_push($results, $author["name"]);
        }
    }
    echo implode(",", $results);
}

// publisher
$db->query("SELECT * FROM publisher;");
$publishers = $db->set();

// book sections
$db->query("SELECT * FROM booksection;");
$booksections = $db->set();

// place of publication 
// book sections
$db->query("SELECT * FROM placeofpublication;");
$placeofpubs = $db->set();
?>
<div class="widget-content widget-content-area" id="filterallbooks">
    <table id="style-3" class="table style-3 dt-table-hover">
        <thead>
            <tr>
                <th>Accession Number</th>
                <th>Rack #</th>
                <th class="text-center">Book Name</th>
                <th>Date Received</th>
                <th class="text-center">Availability</th>


                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($books as $book):
                $accountnumber = $book["AccessionNumber"] ?? 'N/A';
                $datereceived =  $book["DateReceived"];
                $callno = $book["CallNo"];


                $edition = $book["Edition"];
                $vol = $book["Vol"];
                $pages = $book["Pages"];
                $sourceoffund = $book["Sourceoffund"];
                $cost = $book["Cost"];
                $remarks = $book["Remarks"];
                $section = $book["Section"];
                $placeofpublication = $book["PlaceOfPublication"];
                $isbn = $book["ISBN"];
                $bookid = $book['BookId'];
                $bookname = $book['Title'];
                $avail = $book['Availability'];
                $publisher = $book['pubname'];
                $publisherid = $book['publisher'];
                $year = $book['Year'];
                $racknumber = $book['racknumber'];
                $bookauthors = $book['Author'] ?? [];
            ?>
                <tr>
                    <td>
                        <?php echo $accountnumber; ?>
                    </td>
                    <td>
                        <?php echo $racknumber; ?>
                    </td>
                    <td class="text-center">
                        <?php echo $bookname; ?>
                    </td>

                    <td class="text-center">
                        <?php convertDate($datereceived); ?>
                    </td>
                    <td class="text-center">
                        <?php
                        $availTxt = "Available";
                        $badgeTracker = "success";

                        if ($avail <= 0) {
                            $availTxt = "Not Available";
                            $badgeTracker = "danger";
                        }
                        ?>
                        <span class="shadow-none badge badge-<?php echo $badgeTracker; ?>">
                            <?php echo $availTxt; ?>
                        </span>
                    </td>

                    <td class="text-center">
                        <button class="btn btn-info mb-2 me-1" data-bs-toggle="modal" data-bs-target="#exampleModal"
                            onclick='showModal(
                                                                                "<?php echo $bookname; ?>",
                                                                                "<?php echo $publisher; ?>",
                                                                                "<?php echo $year; ?>", 
                                                                                "<?php echo $avail; ?>", 
                                                                                "",
                                                                                
                                                                                "<?php convertDate($datereceived); ?>",
                                                                                 "<?php echo $callno; ?>",
                                                                                 "<?php printauthors($bookid, $authors_lists); ?>",
                                                                                 "<?php echo $edition; ?>",
                                                                                 "<?php echo $vol; ?>",
                                                                                 "<?php echo $pages; ?>",
                                                                                 "<?php echo $sourceoffund; ?>",
                                                                                 "<?php echo $cost; ?>",
                                                                                 "<?php echo $remarks; ?>",
                                                                                "<?php echo $section; ?>",
                                                                                "<?php echo $placeofpublication; ?>",
                                                                                "<?php echo $isbn; ?>"
                                                                                )'>Details</button>

                        <button class="btn btn-warning mb-2 me-1" onclick='showeditModal(
                                                                            "<?php echo $bookname; ?>",
                                                                            "<?php echo $publisherid; ?>",
                                                                            "<?php echo $year; ?>", 
                                                                            "<?php echo $avail; ?>", 
                                                                            <?php echo $bookid; ?>,
                                                                             "<?php
                                                                                //convertDate($datereceived);
                                                                                echo $datereceived;
                                                                                ?>",
                                                                            "<?php echo $callno; ?>",
                                                                            "<?php printauthors($bookid, $authors_lists); ?>",
                                                                            "<?php echo $edition; ?>",
                                                                            "<?php echo $vol; ?>",
                                                                            "<?php echo $pages; ?>",
                                                                            "<?php echo $sourceoffund; ?>",
                                                                            "<?php echo $cost; ?>",
                                                                            "<?php echo $remarks; ?>",
                                                                            "<?php echo $section; ?>",
                                                                            "<?php echo $placeofpublication; ?>",
                                                                            "<?php echo $isbn; ?>"
                                                                            )'>Edit</button>


                        <button class="btn btn-danger mb-2 me-1" onclick="showdeleteModal('<?php echo $bookname; ?>', <?php echo $bookid; ?>)">Remove</button>

                    </td>

                </tr>
            <?php endforeach; ?>


        </tbody>
    </table>
</div>