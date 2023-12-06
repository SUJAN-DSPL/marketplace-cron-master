import{$ as M,r,l as B,m as F,n as g,_ as w,o as D,p as O,j as e,c,d as J,g as K}from"./app-0e1748b6.js";import{$ as L}from"./index-9f942153.js";import{A as Q}from"./AuthenticatedLayout-dcd4ae35.js";import{u as U}from"./useQuery-e1f3fb4f.js";import{r as W,i as X}from"./theme-toggler-b5671715.js";const R="Switch",[G,me]=M(R),[V,Y]=G(R),Z=r.forwardRef((a,s)=>{const{__scopeSwitch:t,name:o,checked:l,defaultChecked:m,required:f,disabled:i,value:u="on",onCheckedChange:x,...k}=a,[b,$]=r.useState(null),z=B(s,h=>$(h)),j=r.useRef(!1),y=b?!!b.closest("form"):!0,[p=!1,A]=F({prop:l,defaultProp:m,onChange:x});return r.createElement(V,{scope:t,checked:p,disabled:i},r.createElement(g.button,w({type:"button",role:"switch","aria-checked":p,"aria-required":f,"data-state":C(p),"data-disabled":i?"":void 0,disabled:i,value:u},k,{ref:z,onClick:D(a.onClick,h=>{A(H=>!H),y&&(j.current=h.isPropagationStopped(),j.current||h.stopPropagation())})})),y&&r.createElement(ae,{control:b,bubbles:!j.current,name:o,value:u,checked:p,required:f,disabled:i,style:{transform:"translateX(-100%)"}}))}),ee="SwitchThumb",te=r.forwardRef((a,s)=>{const{__scopeSwitch:t,...o}=a,l=Y(ee,t);return r.createElement(g.span,w({"data-state":C(l.checked),"data-disabled":l.disabled?"":void 0},o,{ref:s}))}),ae=a=>{const{control:s,checked:t,bubbles:o=!0,...l}=a,m=r.useRef(null),f=L(t),i=O(s);return r.useEffect(()=>{const u=m.current,x=window.HTMLInputElement.prototype,b=Object.getOwnPropertyDescriptor(x,"checked").set;if(f!==t&&b){const $=new Event("click",{bubbles:o});b.call(u,t),u.dispatchEvent($)}},[f,t,o]),r.createElement("input",w({type:"checkbox","aria-hidden":!0,defaultChecked:t},l,{tabIndex:-1,ref:m,style:{...a.style,...i,position:"absolute",pointerEvents:"none",opacity:0,margin:0}}))};function C(a){return a?"checked":"unchecked"}const _=Z,se=te,T=r.forwardRef(({className:a,...s},t)=>e.jsx(_,{className:c("peer inline-flex h-6 w-11 shrink-0 cursor-pointer items-center rounded-full border-2 border-transparent transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 focus-visible:ring-offset-background disabled:cursor-not-allowed disabled:opacity-50 data-[state=checked]:bg-primary data-[state=unchecked]:bg-input",a),...s,ref:t,children:e.jsx(se,{className:c("pointer-events-none block h-5 w-5 rounded-full bg-background shadow-lg ring-0 transition-transform data-[state=checked]:translate-x-5 data-[state=unchecked]:translate-x-0")})}));T.displayName=_.displayName;const S=r.forwardRef(({className:a,...s},t)=>e.jsx("div",{className:"relative w-full overflow-auto",children:e.jsx("table",{ref:t,className:c("w-full caption-bottom text-sm",a),...s})}));S.displayName="Table";const E=r.forwardRef(({className:a,...s},t)=>e.jsx("thead",{ref:t,className:c("[&_tr]:border-b",a),...s}));E.displayName="TableHeader";const P=r.forwardRef(({className:a,...s},t)=>e.jsx("tbody",{ref:t,className:c("[&_tr:last-child]:border-0",a),...s}));P.displayName="TableBody";const re=r.forwardRef(({className:a,...s},t)=>e.jsx("tfoot",{ref:t,className:c("border-t bg-muted/50 font-medium [&>tr]:last:border-b-0",a),...s}));re.displayName="TableFooter";const v=r.forwardRef(({className:a,...s},t)=>e.jsx("tr",{ref:t,className:c("border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted",a),...s}));v.displayName="TableRow";const d=r.forwardRef(({className:a,...s},t)=>e.jsx("th",{ref:t,className:c("h-12 px-4 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0",a),...s}));d.displayName="TableHead";const n=r.forwardRef(({className:a,...s},t)=>e.jsx("td",{ref:t,className:c("p-4 align-middle [&:has([role=checkbox])]:pr-0",a),...s}));n.displayName="TableCell";const q=r.forwardRef(({className:a,...s},t)=>e.jsx("caption",{ref:t,className:c("mt-4 text-sm text-muted-foreground",a),...s}));q.displayName="TableCaption";var N={},ce=X;Object.defineProperty(N,"__esModule",{value:!0});var I=N.default=void 0,oe=ce(W()),de=e,ne=(0,oe.default)((0,de.jsx)("path",{d:"M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"}),"RemoveRedEye");I=N.default=ne;const pe=({auth:a})=>{const s=U({queryKey:["all-schedulers"],queryFn:async()=>(await K.get(route("all-schedulers"))).data});return e.jsx(Q,{user:a.user,header:e.jsx("p",{children:"Schedulers"}),children:e.jsx("div",{className:"border rounded-md p-3",children:e.jsxs(S,{children:[e.jsx(q,{children:"A list of your recent invoices."}),e.jsx(E,{children:e.jsxs(v,{children:[e.jsx(d,{className:"w-[100px]",children:"Action"}),e.jsx(d,{className:"",children:" Name"}),e.jsx(d,{className:"",children:"Timezone"}),e.jsx(d,{className:"",children:"Frequency"}),e.jsx(d,{className:"",children:"Job"}),e.jsx(d,{className:"text-right",children:"Is Active"})]})}),e.jsx(P,{children:s.data&&s.data.map((t,o)=>e.jsxs(v,{children:[e.jsx(n,{className:"font-medium  text-primary",children:e.jsx(J,{href:route("schedulers.show",t.uuid),children:e.jsx(I,{fontSize:"small"})})}),e.jsx(n,{children:t.name}),e.jsx(n,{children:t.timezone}),e.jsx(n,{className:"",children:t.frequencies[0].label}),e.jsx(n,{className:"",children:t.cron_job_class}),e.jsx(n,{className:"text-right",children:e.jsx("div",{className:"flex items-center space-x-2 justify-end",children:e.jsx(T,{id:"airplane-mode",checked:t.is_active})})})]},o))})]})})})};export{pe as default};