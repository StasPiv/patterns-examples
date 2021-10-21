<?php

declare(strict_types = 1);

/**
 * Прототип.
 */
class Page
{
    protected $title;

    protected $body;

    /**
     * @var Author
     */
    protected $author;

    protected $comments = [];

    /**
     * @var \DateTime
     */
    protected $date;

    // +100 приватных полей.

    public function __construct(string $title, string $body, Author $author)
    {
        $this->title = $title;
        $this->body = $body;
        $this->author = $author;
        $this->author->addToPage($this);
        $this->date = new \DateTime();
    }

    public function addComment(string $comment): void
    {
        $this->comments[] = $comment;
    }

    /**
     * Вы можете контролировать, какие данные вы хотите перенести в
     * клонированный объект.
     *
     * Например, при клонировании страницы:
     * - Она получает новый заголовок «Копия ...».
     * - Автор страницы остаётся прежним. Поэтому мы оставляем ссылку на
     * существующий объект, добавляя клонированную страницу в список страниц
     * автора.
     * - Мы не переносим комментарии со старой страницы.
     * - Мы также прикрепляем к странице новый объект даты.
     */
    public function __clone()
    {
        $this->title = "Copy of " . $this->title;
        $this->author->addToPage($this);
        $this->comments = [];
        $this->date = new \DateTime();
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @return \Author
     */
    public function getAuthor(): Author
    {
        return $this->author;
    }

    /**
     * @return array
     */
    public function getComments(): array
    {
        return $this->comments;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }
}

class Author
{
    private $name;

    /**
     * @var Page[]
     */
    private $pages = [];

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function addToPage(Page $page): void
    {
        $this->pages[] = $page;
    }
}


function createDraftOfPage(Page $page) {
    $draft = new Page($page->getTitle(), $page->getBody(), $page->getAuthor());

    foreach ($page->getComments() as $comment) {
        $draft->addComment($comment);
    }

    $draft->getAuthor()->addToPage($draft);

    return $draft;
}

$author = new Author("John Smith");
$page = new Page("Tip of the day", "Keep calm and carry on.", $author);

// ...

$page->addComment("Nice tip, thanks!");

// ...

$draft = createDraftOfPage($page);
echo "Dump of the clone. Note that the author is now referencing two objects.\n\n";
print_r($draft);