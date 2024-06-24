<script async src='https://www.googletagmanager.com/gtag/js?id=G-6NYNXGBKNT'></script>

<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-6NYNXGBKNT');
</script>

<script>
  gtag('event', 'purchase', {
    send_to: 'G-6NYNXGBKNT',
    transaction_id:'<?php echo $_COOKIE['transaction_id'];?>',
    currency: 'EUR',
    value: 1,
items: [
    {
     item_id:'<?php echo $_COOKIE['transaction_id'];?>',
     item_name:'app.solutis.fr',
     item_category:'rachat de credit',
     price: 1,
     quantity: 1
    }
]
  });

</script>