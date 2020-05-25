<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

    <url>
        <loc>https://felicita.kitchen/</loc>
        <priority>1.00</priority>
    </url>
    <url>
        <loc>https://felicita.kitchen/ru/</loc>
        <priority>1.00</priority>
    </url>
    <url>
        <loc>https://felicita.kitchen/ua/</loc>
        <priority>1.00</priority>
    </url>
    <url>
        <loc>https://felicita.kitchen/ru/about</loc>
        <priority>0.50</priority>
    </url>
    <url>
        <loc>https://felicita.kitchen/ua/about</loc>
        <priority>0.50</priority>
    </url>
    <url>
        <loc>https://felicita.kitchen/ru/delivery</loc>
        <priority>0.50</priority>
    </url>
    <url>
        <loc>https://felicita.kitchen/ua/delivery</loc>
        <priority>0.50</priority>
    </url>

    @foreach ($items as $item)
    <url>
        <loc>https://felicita.kitchen/ru/menu/{{$item['link']}}</loc>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>https://felicita.kitchen/ua/menu/{{$item['link']}}</loc>
        <priority>0.80</priority>
    </url>
    @endforeach


</urlset>