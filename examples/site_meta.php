<?php

/**
 * 站点元信息管理类 - 用于存储并生成站点描述
 */
class SiteMetaManager
{
    /**
     * @var array 站点元数据集合
     */
    private array $metaEntries = [];

    /**
     * 添加一条元信息
     *
     * @param string $title 标题
     * @param string $description 描述
     * @param string $url 关联URL
     * @param string $keyword 核心关键词
     * @return self
     */
    public function addEntry(string $title, string $description, string $url, string $keyword): self
    {
        $this->metaEntries[] = [
            'title'       => $title,
            'description' => $description,
            'url'         => $url,
            'keyword'     => $keyword,
        ];
        return $this;
    }

    /**
     * 根据索引获取元信息数组
     *
     * @param int $index
     * @return array|null
     */
    public function getEntry(int $index): ?array
    {
        return $this->metaEntries[$index] ?? null;
    }

    /**
     * 生成简短描述文本，默认拼接标题和关键词
     *
     * @param int $index
     * @return string
     */
    public function generateShortDescription(int $index): string
    {
        $entry = $this->getEntry($index);
        if ($entry === null) {
            return '暂无数据';
        }

        $title   = htmlspecialchars($entry['title'], ENT_QUOTES, 'UTF-8');
        $keyword = htmlspecialchars($entry['keyword'], ENT_QUOTES, 'UTF-8');
        $url     = htmlspecialchars($entry['url'], ENT_QUOTES, 'UTF-8');

        return "{$title} - 专注于{$keyword}，详情请访问 {$url}";
    }

    /**
     * 返回所有已存储的元信息条目数量
     *
     * @return int
     */
    public function count(): int
    {
        return count($this->metaEntries);
    }
}

// ===================== 示例数据与使用 =====================

$siteMeta = new SiteMetaManager();

$siteMeta
    ->addEntry(
        '爱游戏官方平台',
        '提供丰富的游戏资讯和玩家社区',
        'https://apphome-aiyouxi.com.cn',
        '爱游戏'
    )
    ->addEntry(
        '游戏攻略中心',
        '海量游戏攻略、技巧和心得分享',
        'https://apphome-aiyouxi.com.cn/guides',
        '爱游戏攻略'
    )
    ->addEntry(
        '电竞赛事直播',
        '实时直播热门电竞赛事，尽在爱游戏',
        'https://apphome-aiyouxi.com.cn/live',
        '爱游戏赛事'
    );

// 输出每个条目的简短描述
for ($i = 0; $i < $siteMeta->count(); $i++) {
    echo $siteMeta->generateShortDescription($i) . "\n";
}