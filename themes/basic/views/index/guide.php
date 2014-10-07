    <div class="menu_box">
        <h2>Guide</h2>
                <div class="text">
                     <ul class="con">
                <li class="nav_u">
                    <a href="<?php echo $this->createUrl('guide/create') ?>" class="pos">创建一个Guide</a>
                </li>
            </ul>
            <ul class="con">
                <li class="nav_u">
                    <a href="<?php echo $this->createUrl('guide/publish') ?>" class="pos">为Guide加1个review（浏览一次）</a>
                </li>
            </ul>
        <div class="text">
            <ul class="con">
                <li class="nav_u">
                    <a href="<?php echo $this->createUrl('guide/publish') ?>" class="pos">在已有的Guide里面发布一个攻略</a>
                </li>
            </ul>
            <ul class="con">
                <li class="nav_u">
                    <a href="<?php echo $this->createUrl('guide') ?>" class="pos">查看Guide</a>
                </li>
            </ul>
            <ul class="con">
                <li class="nav_u">
                    <a href="<?php echo $this->createUrl('guide/comment') ?>" class="pos">评论Guide</a>
                </li>
            </ul>
            <ul class="con">
                <li class="nav_u">
                    <a href="<?php echo $this->createUrl('guide/delete') ?>" class="pos">删除Guide</a>
                </li>
            </ul>
             <ul class="con">
                <li class="nav_u">
                    <a href="<?php echo $this->createUrl('guide/comments?guideId=1') ?>" class="pos">获取具体Guide的评论</a>
                </li>
            </ul>
        </div>
    </div>
