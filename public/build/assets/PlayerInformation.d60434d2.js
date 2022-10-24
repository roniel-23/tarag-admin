import{_ as P}from"./Authenticated.e82b74e2.js";import{f as k,o as a,c as i,b as t,n as y,a as d,h as r,F as m,P as S,y as C,z as T,u as c,t as l,l as u,v as f,g,A as L,w as b,H as R}from"./app.adb44345.js";import{N as v}from"./NoData.dab6c38a.js";import{S as V}from"./Spinner.b46f03cb.js";import{S as B}from"./sweetalert2.all.30df87eb.js";import"./ApplicationLogo.4f660ea0.js";const j={class:"grid grid-cols-2 text-center text-white font-bold text-xs"},E={key:0,class:"flex flex-col"},I={class:"overflow-x-auto sm:-mx-6 lg:-mx-8"},N={class:"py-2 inline-block min-w-full sm:px-6 lg:px-8"},D={class:"overflow-hidden"},z=S('<table class="min-w-full text-center"><thead class="border-b bg-gray-900"><tr class="text-xs font-medium text-white"><th scope="col" class="px-6 py-2"> YEAR </th><th scope="col" class="px-6 py-2"> PTS </th><th scope="col" class="px-6 py-2"> REB </th><th scope="col" class="px-6 py-2"> AST </th><th scope="col" class="px-6 py-2"> BLK </th><th scope="col" class="px-6 py-2"> STL </th><th scope="col" class="px-6 py-2"> FLS </th></tr></thead><tbody><tr class="bg-white border-b"></tr></tbody></table>',1),F={key:1,class:"flex flex-col"},G={class:"overflow-x-auto sm:-mx-6 lg:-mx-8"},H={class:"py-2 inline-block min-w-full sm:px-6 lg:px-8"},O={class:"overflow-hidden"},U=S('<table class="min-w-full text-center"><thead class="border-b bg-gray-900"><tr class="text-xs font-medium text-white"><th scope="col" class="px-6 py-2"> DATE </th><th scope="col" class="px-6 py-2"> PTS </th><th scope="col" class="px-6 py-2"> REB </th><th scope="col" class="px-6 py-2"> AST </th><th scope="col" class="px-6 py-2"> BLK </th><th scope="col" class="px-6 py-2"> STL </th><th scope="col" class="px-6 py-2"> FLS </th></tr></thead><tbody></tbody></table>',1),K={__name:"PlayerStats",setup(e){const s=k(!0);return(_,o)=>(a(),i(m,null,[t("div",j,[t("div",{onClick:o[0]||(o[0]=x=>s.value=!s.value),class:y([s.value?"bg-gray-900":"bg-white text-gray-900","border border-gray-900 py-2 cursor-pointer hover:bg-gray-900 hover:text-white"])}," CAREER STATS ",2),t("div",{onClick:o[1]||(o[1]=x=>s.value=!s.value),class:y([s.value?"bg-white text-gray-900":"bg-gray-900","border border-gray-900 py-2 cursor-pointer hover:bg-gray-900 hover:text-white"])}," GAME LOG ",2)]),s.value?(a(),i("div",E,[t("div",I,[t("div",N,[t("div",D,[z,d(v)])])])])):r("",!0),s.value?r("",!0):(a(),i("div",F,[t("div",G,[t("div",H,[t("div",O,[U,d(v)])])])]))],64))}},w=C({id:"playersAddress",state:()=>({address:[],playerAddress:null,loading:!1,error:null}),getters:{},actions:{async fetchAddress(){this.address=[],this.loading=!0;try{this.address=await fetch("/api/address/").then(e=>e.json())}catch(e){this.error=e}finally{this.loading=!1}},async fetchPlayerAddress(e){this.playerAddress=null,this.loading=!0;try{this.playerAddress=await fetch(`/api/player/address/${e}`).then(s=>s.json())}catch(s){this.error=s}finally{this.loading=!1}}}}),Y={key:0,class:"text-center text-gray-500 mt-10"},q=t("p",{class:"mt-5"},"Loading Player Information",-1),M={key:1},W={class:"border border-gray-100 border-1 p-3 bg-white rounded-t-lg"},J={class:"flex justify-start items-center gap-5"},Q={class:"flex gap-4 items-center"},X=["src","alt"],Z={class:"grid grid-row-3 pr-10"},tt={class:"text-red-600 text-4xl font-bold"},et={class:"text-black text-3xl font-semibold"},st={class:"text-black text-3xl font-semibold"},ot=t("hr",{class:"text-gray-900 mt-2"},null,-1),lt={class:"text-gray-700 text-2xl font-semibold mt-2"},at={class:"text-gray-500"},it=g(" Status: "),ct={key:0},rt={key:1},dt={class:"grid grid-cols-2 gap-2 text-center text-white mt-2"},nt={class:"bg-blue-500 py-1 px-4"},ht={class:"text-xl font-semibold shadow-xl"},_t=t("p",{class:"text-sm font-semibold"},[t("small",null,"G! Coin")],-1),xt={class:"bg-blue-500 py-1 px-4"},pt={class:"text-xl font-semibold shadow-xl"},yt=t("p",{class:"text-sm font-semibold"},[t("small",null,"Reward")],-1),gt={class:"text-lg text-gray-400 px-10"},mt=t("div",{class:"text-xs"},"Weight",-1),ut=t("div",{class:"text-black font-semibold"}," 72 kg ",-1),ft=t("div",{class:"text-xs mt-4"},"Height",-1),bt={class:"text-black font-semibold"},vt=t("div",{class:"text-xs mt-4"},"Position",-1),wt={class:"text-black font-semibold"},kt={key:0,class:"text-lg text-gray-400"},St=t("div",{class:"text-xs"},"Address",-1),$t={class:"text-black font-semibold"},At=t("br",null,null,-1),Pt=t("div",{class:"text-xs mt-4"},"Second Address",-1),Ct={class:"text-black font-semibold"},Tt=t("div",{class:"text-xs mt-4"},"zipcode",-1),Lt={class:"text-black font-semibold"},Rt={key:1,class:"mx-auto p-2 items-center shadow-lg"},Vt={key:0,class:"flex justify-end text-red-500"},Bt=t("i",{class:"px-1 fa-solid fa-xmark hover:scale-125"},null,-1),jt=[Bt],Et={class:"mb-4"},It=["src"],Nt={key:1,class:"grid text-white grid-cols-4 gap-1"},Dt=t("button",{class:"shadow-lg col-span-2 bg-gray-900 hover:bg-gray-800"},"Request another ID",-1),zt={class:"border border-gray-100 border-1 bg-white my-1"},Ft={__name:"PlayerProfile",props:{player:Object},setup(e){const s=e,{fetchPlayerAddress:_}=w(),{playerAddress:o,loading:x,error:$}=T(w()),n=k(!1);_(s.player.user_id);function p(){n.value=!n.value}function A(){B.fire({title:"Player will be set to verified.",icon:"info",showCancelButton:!0,confirmButtonText:"Yes, Verify Player"}).then(h=>{h.isConfirmed&&(L.Inertia.post(`/verification/player/${s.player.user_id}`),location.reload())})}return(h,Ot)=>(a(),i(m,null,[c(x)?(a(),i("div",Y,[d(V),q])):r("",!0),c($)?(a(),i("div",M)):r("",!0),t("div",W,[t("div",J,[t("div",Q,[t("img",{class:"object-contain h-64 w-72 p-1 shadow-lg",src:h.$imageURL+"/uploads/"+e.player.photo,alt:e.player.code_name},null,8,X),t("div",Z,[t("div",tt,l(e.player.user_id),1),t("div",et,l(e.player.first_name),1),t("div",st,l(e.player.last_name),1),ot,t("div",lt,l(e.player.code_name),1),t("div",at,[it,t("span",{onClick:p,class:y(["text-white font-semibold rounded-full px-2 cursor-pointer",e.player.verified==1?"bg-green-500":"bg-red-500"])},[e.player.verified==1?(a(),i("span",ct," Verified ")):(a(),i("span",rt," Unverified "))],2)]),t("div",dt,[t("div",nt,[t("p",ht,l(e.player.gcoin)+".00",1),_t]),t("div",xt,[t("p",pt,l(e.player.gcoin_reward)+".00",1),yt])])])]),u(t("div",gt,[mt,ut,ft,t("div",bt,l(e.player.height),1),vt,t("div",wt,l(e.player.position),1)],512),[[f,!n.value]]),c(o)?(a(),i("div",kt,[St,t("div",$t,[g(l(c(o).address)+" ",1),At,g(l(c(o).barangay),1)]),Pt,t("div",Ct,l(c(o).municipality)+" "+l(c(o).province),1),Tt,t("div",Lt,l(c(o).zipcode),1)])):r("",!0),c(o)?u((a(),i("div",Rt,[e.player.verified==1?(a(),i("div",Vt,[t("button",{onClick:p},jt)])):r("",!0),t("div",Et,[t("img",{class:"object-contain h-48 w-80",src:h.$imageURL+"/uploads/"+c(o).id_photo,alt:"Submitted ID"},null,8,It)]),e.player.verified==0?(a(),i("div",Nt,[t("button",{onClick:A,class:"shadow-lg bg-green-600 rounded-l-md hover:bg-green-700"},"Accept"),Dt,t("button",{onClick:p,class:"shadow-lg bg-red-600 rounded-r-md hover:bg-red-700"},"Close")])):r("",!0)],512)),[[f,n.value]]):r("",!0)])]),t("div",zt,[d(K)])],64))}},Gt=t("h2",{class:"text-xl font-semibold leading-tight text-gray-800"}," Player Information ",-1),Ht={class:"mt-5"},Jt={__name:"PlayerInformation",props:{player:Object},setup(e){return(s,_)=>(a(),i(m,null,[d(c(R),{title:"Player Info"}),d(P,null,{header:b(()=>[Gt]),default:b(()=>[t("div",Ht,[d(Ft,{player:e.player},null,8,["player"])])]),_:1})],64))}};export{Jt as default};
