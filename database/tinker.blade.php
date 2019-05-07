$category1 = new App\Category
$category1->'name' = 'Exclusives';
$category1->save();

$category2 = new \App\Category;
$category2->name = 'Non-exclusives';
$category2->save();