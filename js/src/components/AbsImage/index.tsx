import React, { FC } from 'react'
import { MapIcon } from '@/components'

type TMapData = {
	building: string,
	maps: {
		postId: number,
		top: number,
		left: number,
	}[]
}

const MAP_DATA: TMapData[] = [
	{
		building: 'building1',
		maps: [
			{
				postId: 32090,
				top: 43,
				left: 70,
			},
			{
				postId: 32084,
				top: 50,
				left: 67,
			},
			{
				postId: 32087,
				top: 60,
				left: 50,
			}
		]
	},
	{
		building: 'building2',
		maps: [
			{
				postId: 31564,
				top: 72,
				left: 36,
			},
			{
				postId: 32072,
				top: 62,
				left: 46,
			},
			{
				postId: 32069,
				top: 67,
				left: 57,
			}
		]
	},
	{
		building: 'building3',
		maps: [
			{
				postId: 32069,
				top: 69,
				left: 23,
			},
			{
				postId: 31874,
				top: 70,
				left: 33,
			},
			{
				postId: 32075,
				top: 64,
				left: 40,
			},
			{
				postId: 31874,
				top: 74,
				left: 49,
			},
			{
				postId: 32081,
				top: 62,
				left: 63,
			},
			{
				postId: 32069,
				top: 63,
				left: 73,
			}
		]
	}
]

export const AbsImage: FC<{
	className: string,
	width: number,
	top: number,
	left: number,
}> = ({
	className,
	width = 20,
	top = 0,
	left = 0,
}) => {
		const data = MAP_DATA.find(item => item.building === className)
		const maps = (data?.maps || []) as TMapData['maps']
		return (
			<div className={`sh-abs-image ${className}`} style={{
				width: `${width}%`,
				top: `${top}%`,
				left: `${left}%`,
			}}>
				{maps.map(({ postId, top, left }) => (
					<MapIcon
						key={`${postId}${top}${left}`}
						top={top}
						left={left}
					/>
				))}
			</div>
		)
	}
