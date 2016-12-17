<?php

return [
	"/authors/([0-9]+)" => "author/view/$1",
	"/books/([0-9]+)" => "book/view/$1",
	"/publishers/([0-9]+)" => "publisher/view/$1",
	"/authors" => "author/index",
	"/books" => "book/index",
	"/publishers" => "publisher/index",
    "/" => "main/index"
];