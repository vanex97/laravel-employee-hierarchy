import {json} from 'd3-fetch';
import {OrgChart} from 'd3-org-chart';

let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
let dataUrl = $(".chart-container").attr('data');

json(dataUrl, {
    method: 'post',
    headers: {
        'X-CSRF-TOKEN': CSRF_TOKEN
    }
}).then((data) => {
    new OrgChart()
        .container('.chart-container')
        .data(data)
        .nodeWidth((d) => 250)
        .initialZoom(0.7)
        .nodeHeight((d) => 175)
        .childrenMargin((d) => 40)
        .compactMarginBetween((d) => 15)
        .compactMarginPair((d) => 80)
        .nodeContent(function (d, i, arr, state) {
            return `
            <div style="padding-top:30px;background-color:none;margin-left:1px;height:${
                d.height
            }px;border-radius:2px;overflow:visible;">
              <div style="height:${
                d.height - 32
            }px;padding-top:0px;background-color:white;border:1px solid lightgray;border-radius: .25rem;">
                <img src=" ${
                d.data.photo
            }" style="margin-top:-30px;margin-left:${d.width / 2 - 30}px;border-radius:100px;width:60px;height:60px;" />
               <div style="margin-top:-31px;background-color:#007bff;height:3px;width:${
                d.width - 2
            }px;border-radius:.25rem .25rem 0 0"></div>

               <div style="padding:20px; padding-top:35px;text-align:center">
                   <a href="${d.data.profileUrl}" style="font-size:21px;"> ${
                d.data.name
            } </a>
                   <div class="text-muted" style="color:#404040;font-size:16px;margin-top:4px"> ${
                d.data.position
            } </div>
               </div>
               <div style="text-align: center"> Subordinates: ${d.data._directSubordinates}</div>
              </div>
      </div>`;
        })
        .render();
});


