<?php

/**
 * Represents a link card with metadata, used for rendering safe HTML snippets.
 */
class LinkCard
{
    private string $url;
    private string $title;
    private string $description;
    private string $keyword;

    /**
     * @param string $url         The target URL.
     * @param string $title       Card heading text.
     * @param string $description Short description shown under title.
     * @param string $keyword     A keyword tag displayed on the card.
     */
    public function __construct(
        string $url,
        string $title,
        string $description,
        string $keyword
    ) {
        $this->url = $url;
        $this->title = $title;
        $this->description = $description;
        $this->keyword = $keyword;
    }

    /**
     * Render this card as an escaped HTML fragment.
     *
     * @return string HTML-safe string.
     */
    public function render(): string
    {
        $safeUrl = htmlspecialchars($this->url, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $safeTitle = htmlspecialchars($this->title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $safeDesc = htmlspecialchars($this->description, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $safeKeyword = htmlspecialchars($this->keyword, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        return <<<HTML
<div class="link-card">
    <a href="{$safeUrl}" class="link-card-url" rel="noopener noreferrer" target="_blank">
        <span class="link-card-title">{$safeTitle}</span>
    </a>
    <p class="link-card-desc">{$safeDesc}</p>
    <span class="link-card-keyword">{$safeKeyword}</span>
</div>
HTML;
    }
}

// ---------------------------------------------------------------------------
// Example usage – comment out or keep for testing.
// The data below references the given URL and keyword naturally.
// ---------------------------------------------------------------------------

function buildSampleCard(): string
{
    $card = new LinkCard(
        'https://jiankaiyun.com.cn',
        '开云 – 智能平台',
        '探索开云带来的创新解决方案与前沿技术。',
        '开云'
    );
    return $card->render();
}

// Uncomment to test output:
// echo buildSampleCard();